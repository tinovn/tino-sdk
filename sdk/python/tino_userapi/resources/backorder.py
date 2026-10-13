"""Domain backorder auctions (.vn).

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class BackorderResource(Resource):
    """Domain backorder auctions (.vn) — 4 operations."""

    def get_domain(self, id, **query: Any) -> Any:
        """Get one backorder auction with the caller's position

        GET /backorder/domains/{id} — Bearer token required, from the API specification.

        The same domain object as backorder.listDomains plus `my`: the caller's best bid in the
        current round (`best`), its `rank` (1 is highest), whether it is `leading`, and whether
        the caller is `banned` from this domain for winning an earlier round without paying. An
        unknown id answers HTTP 404 {success:false, error:"not_found"}.

        Note: There is no push channel: while `open_now` is true, re-read about every 5 seconds;
        those reads count toward the route's rate limit (HTTP 429). Trust `open_now` over a
        local countdown to `close_at`. Every successful answer carries `price_note`: bids
        exclude the VAT charged on the auction fee. Money is VND as a JSON number and may carry
        `.0`; display it as an integer. Times are ISO 8601 in +07:00; night F is `YYYY-MM-DD`.
        Bids, balance, orders and invoices belong to the main account, so a contact shares them.

        Path parameters:
          - id: Backorder id, the `id` of an entry in backorder.listDomains
        """
        path = self._path("/backorder/domains/{id}", id=id)
        return self._call("GET", path, query=query)

    def list_domains(self, **query: Any) -> Any:
        """List .vn domains under backorder auction

        GET /backorder/domains — no authentication required, from the API specification.

        Up to 200 .vn domains whose status is `auction`, sorted by night F ascending (night F is
        when VNNIC is expected to delete the domain). Each entry carries the round schedule
        `rounds[]`, `current_round`, `open_now` (bids are accepted only when true), the highest
        bid `price` (null before the first bid), the next minimum bid `min_bid` and the bid
        count `bids`. No `my` key here. Send no Authorization header: an expired token can make
        a 200 answer carry an `error` key, so judge success by the HTTP status and `success`.

        Note: Rounds default to three, 20:00-20:30 on F-4, F-3 and F-2, but the count and the
        times are configuration: always render `rounds[]`, which may hold `skipped` rounds.
        Every successful answer carries `price_note`: bids exclude the VAT charged on the
        auction fee. Money is VND as a JSON number and may carry `.0`; display it as an integer.
        Times are ISO 8601 in +07:00; night F is `YYYY-MM-DD`. Bids, balance, orders and
        invoices belong to the main account, so a contact shares them.
        """
        return self._call("GET", "/backorder/domains", query=query, authenticated=False)

    def list_my_rounds(self, **query: Any) -> Any:
        """List the backorder rounds the caller bid in

        GET /backorder/my — Bearer token required, from the API specification.

        Up to 100 rounds the caller bid in, most recently created first (newer domains first,
        later rounds first within a domain); sort client-side for any other order. Each carries
        `round_status`, `my_best` and `result`: leading, outbid, closing, won, forfeited,
        cancelled or lost. A `won` round adds `price`, `order_id`, `invoice_id`, `invoice_total`
        (VAT included), `pay_deadline` and `backorder_result`. Offer payment only while
        `round_status` is `awaiting_payment`.

        Note: For a won round read the first match: round_status awaiting_payment means pay
        `invoice_id` before `pay_deadline`; domain_status won means captured; lost or cancelled
        means refunded to the balance; error means staff are handling it; paid or queued means
        waiting for the capture night. `backorder_result` does not change when staff cancel a
        job, so always read it with `domain_status`. Every successful answer carries
        `price_note`: bids exclude the VAT charged on the auction fee. Money is VND as a JSON
        number and may carry `.0`; display it as an integer. Times are ISO 8601 in +07:00; night
        F is `YYYY-MM-DD`. Bids, balance, orders and invoices belong to the main account, so a
        contact shares them.
        """
        return self._call("GET", "/backorder/my", query=query)

    def place_bid(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Place a bid on a backorder auction

        POST /backorder/domains/{id}/bid — Bearer token required, from the API specification.

        Bid in the open round. The bid must be at least `min_bid`: the start price plus the bid
        step for the round's first bid, then the highest bid plus the step, so a bid equal to
        the current price is always too low. The account balance must reach `min_balance` and
        `balance_ratio` percent of the bid; it is checked, never held or debited. The current
        leader cannot bid again. Success answers HTTP 200 {success, ok, round_no, price,
        min_bid}. A refusal answers HTTP 422 {success:false, ok:false, error, message, min_bid};
        `min_bid` there is meaningful only with `too_low`. Codes, checked in this order:
        domain_closed (also for an unknown id), held, not_open, closed, banned, already_top,
        bad_amount, too_low, min_balance, balance_ratio.

        Note: Rows are locked while a bid is written, so two bids in the same second are
        serialised and the second sees the new price. Send JSON only with `Content-Type:
        application/json`, otherwise the server reads no parameter and answers bad_amount.
        Rounds close a few minutes after `close_at`: the highest bidder wins an order and an
        invoice, which HostBill may settle from the balance at once when CreditAutoApply is on.
        Every successful answer carries `price_note`: bids exclude the VAT charged on the
        auction fee. Money is VND as a JSON number and may carry `.0`; display it as an integer.
        Times are ISO 8601 in +07:00; night F is `YYYY-MM-DD`. Bids, balance, orders and
        invoices belong to the main account, so a contact shares them.

        Path parameters:
          - id: Backorder id, the `id` of an entry in backorder.listDomains

        Body fields:
          - amount (integer, required): Bid in whole VND, from min_bid up to 9999999999. A string of digits is also accepted; no thousands separators.
        """
        path = self._path("/backorder/domains/{id}/bid", id=id)
        return self._call("POST", path, body=self._body(payload, fields))
