#!/usr/bin/env node
// End-to-end walkthrough: log in with a one-time code, then read the account.
//
//     node examples/nodejs-otp-login-and-overview.mjs you@example.com
//
// Only read-only endpoints are called, so it is safe to run against a real account.

import { createInterface } from 'node:readline/promises';
import { readFile, writeFile, chmod } from 'node:fs/promises';
import { homedir } from 'node:os';
import { join } from 'node:path';

import { TinoClient, TinoApiError, TinoNotFoundError } from '../sdk/nodejs/src/index.js';

const SESSION_FILE = join(homedir(), '.tino-sdk-session.json');

async function loadSession() {
  try {
    return JSON.parse(await readFile(SESSION_FILE, 'utf8'));
  } catch {
    return {};
  }
}

async function saveSession(token, refresh) {
  // A refresh rotates both tokens, so always write the pair back together.
  await writeFile(SESSION_FILE, JSON.stringify({ token, refresh }));
  await chmod(SESSION_FILE, 0o600);
}

async function main() {
  const email = process.argv[2];
  if (!email) {
    console.error(`usage: ${process.argv[1]} <email>`);
    process.exit(1);
  }

  const stored = await loadSession();
  const client = new TinoClient({
    token: stored.token ?? null,
    refreshToken: stored.refresh ?? null,
    onTokenRefresh: saveSession,
  });

  if (!client.token) {
    const sent = await client.requestLoginOtp(email);
    console.log(`A one-time code was sent via ${sent.via ?? 'email'}.`);
    const rl = createInterface({ input: process.stdin, output: process.stdout });
    const code = (await rl.question('Code: ')).trim();
    rl.close();
    await client.verifyLoginOtp(email, code);
    await saveSession(client.token, client.refreshToken);
    console.log('Signed in.\n');
  }

  const { client: account } = await client.account.getDetails();
  console.log(`Account   ${account.email} (id ${account.id})`);

  const { total } = await client.account.getSummary();
  console.log(`Totals    ${total.services} services · ${total.domains} domains · `
    + `${total.invoices} invoices · ${total.tickets} tickets`);

  const { details: balance } = await client.billing.getBalance();
  console.log(`Balance   ${balance.acc_balance} ${balance.currency} (credit ${balance.acc_credit})\n`);

  console.log('Active services');
  const { services } = await client.services.list({ filter: { hide_cancelled: 1 } });
  for (const service of services ?? []) {
    console.log(`  ${String(service.id).padStart(8)}  ${service.domain.padEnd(40)}`
      + `${service.status.padEnd(10)} next due ${service.next_due}`);
  }

  console.log('\nDomains');
  const { domains } = await client.domains.list();
  for (const domain of domains ?? []) {
    console.log(`  ${String(domain.id).padStart(8)}  ${domain.name.padEnd(40)} expires ${domain.expires}`);
  }

  console.log('\nUnpaid invoices');
  const due = await client.billing.listInvoicesDue();
  for (const invoice of due.invoices_due ?? []) {
    console.log(`  ${String(invoice.id).padStart(8)}  ${String(invoice.total).padStart(14)}  due ${invoice.duedate}`);
  }

  console.log('\nDNS zones');
  const { zones } = await client.dns.listZonesAll();
  for (const zone of zones ?? []) {
    try {
      const { records } = await client.dns.getZone(zone.service_id, zone.domain_id);
      console.log(`  ${zone.name.padEnd(40)} ${Object.keys(records).length} record(s)`);
    } catch (error) {
      if (!(error instanceof TinoNotFoundError)) throw error;
      console.log(`  ${zone.name.padEnd(40)} (not readable)`);
    }
  }
}

main().catch((error) => {
  if (error instanceof TinoApiError) {
    console.error(`API error: ${error}`);
    process.exit(1);
  }
  throw error;
});
