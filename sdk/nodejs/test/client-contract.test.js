// Offline tests for the parts of the SDK that encode the API's quirks.
// The global fetch is stubbed, so the tests assert on what the client would send
// and on how it interprets what comes back.

import test from 'node:test';
import assert from 'node:assert/strict';

import { TinoClient, encodeQuery } from '../src/index.js';
import { TinoAuthError, TinoNotFoundError, TinoValidationError } from '../src/errors.js';

/** Install a fetch stub that replies with the given payloads in order. */
function stubFetch(...responses) {
  const calls = [];
  const original = globalThis.fetch;
  globalThis.fetch = async (url, init) => {
    calls.push({ url, init });
    const [status, payload] = responses.shift();
    const text = JSON.stringify(payload);
    return {
      status,
      headers: new Headers(),
      async arrayBuffer() {
        return new TextEncoder().encode(text).buffer;
      },
    };
  };
  return { calls, restore: () => { globalThis.fetch = original; } };
}

// --------------------------------------------------------------- query encoding

test('encodeQuery follows the API conventions', () => {
  assert.equal(encodeQuery({ page: 0 }), 'page=0');
  assert.equal(encodeQuery({ page: null, perpage: 25 }), 'perpage=25');
  assert.equal(encodeQuery({ active: true, hidden: false }), 'active=1&hidden=0');
  assert.equal(encodeQuery({ filter: { hide_cancelled: 1 } }), 'filter%5Bhide_cancelled%5D=1');
  assert.equal(encodeQuery({ tlds: ['.com', '.vn'] }), 'tlds%5B%5D=.com&tlds%5B%5D=.vn');
});

test('path parameters are percent-encoded', async () => {
  const stub = stubFetch([200, []]);
  try {
    await new TinoClient().location.listCitiesByStateName('Thành phố Hồ Chí Minh');
    assert.ok(stub.calls[0].url.includes('Th%C3%A0nh%20ph%E1%BB%91'));
  } finally {
    stub.restore();
  }
});

// ------------------------------------------------------------- error detection

test('an error in the body of an HTTP 200 still throws', async () => {
  const stub = stubFetch([200, { error: ['unauthorized'] }]);
  try {
    await assert.rejects(
      () => new TinoClient({ token: 't' }).account.getDetails(),
      TinoAuthError,
    );
  } finally {
    stub.restore();
  }
});

test('an unknown route throws TinoNotFoundError', async () => {
  const stub = stubFetch([404, { error: ['invalid method'] }]);
  try {
    await assert.rejects(
      () => new TinoClient({ token: 't' }).services.listOsTemplates(1),
      TinoNotFoundError,
    );
  } finally {
    stub.restore();
  }
});

test('a string error next to success:false throws with the message', async () => {
  const stub = stubFetch([200, { success: false, error: 'query is required' }]);
  try {
    await assert.rejects(
      () => new TinoClient({ token: 't' }).domains.suggest({ query: '' }),
      (error) => error instanceof TinoValidationError
        && error.errors.length === 1 && error.errors[0] === 'query is required',
    );
  } finally {
    stub.restore();
  }
});

test('a bare array error throws', async () => {
  const stub = stubFetch([200, ['file_not_found']]);
  try {
    await assert.rejects(
      () => new TinoClient({ token: 't' }).support.getAttachment('1'),
      TinoNotFoundError,
    );
  } finally {
    stub.restore();
  }
});

test('a successful body is returned untouched', async () => {
  const payload = { success: true, invoices: [{ id: '1', total: '10.00' }] };
  const stub = stubFetch([200, payload]);
  try {
    assert.deepEqual(await new TinoClient({ token: 't' }).billing.listInvoices(), payload);
  } finally {
    stub.restore();
  }
});

// ----------------------------------------------------------- token management

test('an auth error triggers one refresh and replays the call', async () => {
  const stub = stubFetch(
    [200, { error: ['token_expired'] }],
    [200, { token: 'new-access', refresh: 'new-refresh' }],
    [200, { details: { acc_balance: 1 } }],
  );
  try {
    const saved = {};
    const client = new TinoClient({
      token: 'old',
      refreshToken: 'old-refresh',
      onTokenRefresh: (token, refresh) => Object.assign(saved, { token, refresh }),
    });

    assert.deepEqual(await client.billing.getBalance(), { details: { acc_balance: 1 } });
    assert.equal(client.token, 'new-access');
    assert.deepEqual(saved, { token: 'new-access', refresh: 'new-refresh' });
    assert.ok(stub.calls[1].url.endsWith('/token'));
    assert.equal(stub.calls[2].init.headers.Authorization, 'Bearer new-access');
  } finally {
    stub.restore();
  }
});

test('a dead refresh token is not retried forever', async () => {
  const stub = stubFetch(
    [200, { error: ['token_expired'] }],
    [200, { error: ['refresh_token_invalid'] }],
  );
  try {
    const client = new TinoClient({ token: 'old', refreshToken: 'dead' });
    await assert.rejects(() => client.billing.getBalance());
  } finally {
    stub.restore();
  }
});

test('verifyLoginOtp stores both tokens', async () => {
  const stub = stubFetch([200, { token: 'a', refresh: 'b', client: { id: '1' } }]);
  try {
    const client = new TinoClient();
    await client.verifyLoginOtp('user@example.com', '123456');
    assert.equal(client.token, 'a');
    assert.equal(client.refreshToken, 'b');
  } finally {
    stub.restore();
  }
});

test('public endpoints send no Authorization header', async () => {
  const stub = stubFetch([200, {}]);
  try {
    await new TinoClient({ token: 'secret' }).location.listCountries();
    assert.equal(stub.calls[0].init.headers.Authorization, undefined);
  } finally {
    stub.restore();
  }
});

test('protected endpoints send the token', async () => {
  const stub = stubFetch([200, {}]);
  try {
    await new TinoClient({ token: 'secret' }).account.getDetails();
    assert.equal(stub.calls[0].init.headers.Authorization, 'Bearer secret');
  } finally {
    stub.restore();
  }
});

// ------------------------------------------------------------- body handling

test('a request body is serialised as JSON', async () => {
  const stub = stubFetch([200, {}]);
  try {
    await new TinoClient({ token: 't' }).support.createTicket({ dept_id: 2, subject: 'Hi' });
    assert.deepEqual(JSON.parse(stub.calls[0].init.body), { dept_id: 2, subject: 'Hi' });
  } finally {
    stub.restore();
  }
});

test('no body is sent when none is supplied', async () => {
  const stub = stubFetch([200, {}]);
  try {
    await new TinoClient({ token: 't' }).services.manualRenew(1);
    assert.equal(stub.calls[0].init.body, undefined);
  } finally {
    stub.restore();
  }
});
