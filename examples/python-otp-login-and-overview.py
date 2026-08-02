#!/usr/bin/env python3
"""End-to-end walkthrough: log in with a one-time code, then read the account.

    python3 examples/python-otp-login-and-overview.py you@example.com

Only read-only endpoints are called, so it is safe to run against a real account.
"""
import json
import os
import sys

sys.path.insert(0, os.path.join(os.path.dirname(__file__), "..", "sdk", "python"))

from tino_userapi import TinoClient, TinoApiError, TinoNotFoundError  # noqa: E402

TOKEN_FILE = os.path.expanduser("~/.tino-sdk-session.json")


def load_client() -> TinoClient:
    """Reuse a stored session when there is one, otherwise start empty."""
    stored = {}
    if os.path.exists(TOKEN_FILE):
        with open(TOKEN_FILE, encoding="utf-8") as handle:
            stored = json.load(handle)

    def persist(token: str, refresh: str) -> None:
        # A refresh rotates both tokens, so always write the pair back together.
        with open(TOKEN_FILE, "w", encoding="utf-8") as handle:
            json.dump({"token": token, "refresh": refresh}, handle)
        os.chmod(TOKEN_FILE, 0o600)

    return TinoClient(
        token=stored.get("token"),
        refresh_token=stored.get("refresh"),
        on_token_refresh=persist,
    )


def login(client: TinoClient, email: str) -> None:
    sent = client.request_login_otp(email)
    print(f"A one-time code was sent via {sent.get('via', 'email')}.")
    client.verify_login_otp(email, input("Code: ").strip())
    with open(TOKEN_FILE, "w", encoding="utf-8") as handle:
        json.dump({"token": client.token, "refresh": client.refresh_token}, handle)
    os.chmod(TOKEN_FILE, 0o600)
    print("Signed in.\n")


def main() -> None:
    if len(sys.argv) < 2:
        sys.exit(f"usage: {sys.argv[0]} <email>")
    email = sys.argv[1]

    client = load_client()
    if not client.token:
        login(client, email)

    details = client.account.get_details()["client"]
    print(f"Account   {details['email']} (id {details['id']})")

    summary = client.account.get_summary()["total"]
    print(f"Totals    {summary['services']} services · {summary['domains']} domains · "
          f"{summary['invoices']} invoices · {summary['tickets']} tickets")

    balance = client.billing.get_balance()["details"]
    print(f"Balance   {balance['acc_balance']} {balance['currency']} "
          f"(credit {balance['acc_credit']})\n")

    print("Active services")
    for service in client.services.list(filters={"hide_cancelled": 1})["services"]:
        print(f"  {service['id']:>8}  {service['domain']:<40} {service['status']:<10} "
              f"next due {service['next_due']}")

    print("\nDomains")
    for domain in client.domains.list().get("domains") or []:
        print(f"  {domain['id']:>8}  {domain['name']:<40} expires {domain['expires']}")

    print("\nUnpaid invoices")
    for invoice in client.billing.list_invoices_due().get("invoices_due") or []:
        print(f"  {invoice['id']:>8}  {invoice['total']:>14}  due {invoice['duedate']}")

    print("\nDNS zones")
    for zone in client.dns.list_zones_all().get("zones") or []:
        try:
            records = client.dns.get_zone(zone["service_id"], zone["domain_id"])["records"]
            print(f"  {zone['name']:<40} {len(records)} record(s)")
        except TinoNotFoundError:
            print(f"  {zone['name']:<40} (not readable)")


if __name__ == "__main__":
    try:
        main()
    except TinoApiError as error:
        sys.exit(f"API error: {error}")
