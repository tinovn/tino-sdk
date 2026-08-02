#!/usr/bin/env python3
"""Turn captured live responses into publishable documentation samples.

Live captures contain real account data (names, national id, phone numbers, VM root
passwords, one-shot login links). This script keeps the *shape* of each response and
replaces every value that could identify or compromise the account, so the samples in
docs/ are safe to publish.

Usage:
    python3 tools/sanitize-samples.py <captured-dir>... -o spec/response-samples.json
"""
from __future__ import annotations

import argparse
import json
import os
import re
from typing import Any, Dict

# Keys whose value is replaced wholesale, whatever it contains.
SECRET_KEYS = {
    "token", "refresh", "refresh_token", "access_token", "password", "passwd", "pass",
    "epp_code", "authcode", "auth_code", "secret", "api_key", "apikey", "key",
    "private_key", "signature", "session", "cookie", "authorization", "otp",
    "sshkey", "ssh_key", "public_key", "url_login", "loginurl", "autologin",
    "newpass", "newpassword", "new_password", "epp", "authinfo", "content",
}
IDENTITY_KEYS = {
    "email", "phonenumber", "phone", "mobile", "nationalid", "taxid", "birthday",
    "firstname", "lastname", "fullname", "name_owner", "companyname", "address1",
    "address2", "bankaccount", "bankname", "zaloauth", "ip", "remote_addr", "host",
    "client_id", "clientid",
}
PLACEHOLDER = {
    "token": "<token>",
    "email": "user@example.com",
    "phonenumber": "+84.900000000",
    "nationalid": "000000000000",
    "firstname": "Nguyen Van",
    "lastname": "A",
    "companyname": "Example Company Ltd",
    "address1": "123 Example Street",
    "ip": "203.0.113.10",
    "host": "host.example",
    "taxid": "0100000000",
    "birthday": "01/01/1990",
}

EMAIL_RE = re.compile(r"[\w.+-]+@[\w-]+\.[\w.-]+")
# Some payloads embed absolute deep links into Tino's internal panel. They carry record
# ids and are not part of the public contract, so they are replaced wholesale.
PANEL_LINK_RE = re.compile(r"https?://[\w.-]*manage\.tino\.vn\S*")
# Infrastructure details that identify the captured account's machines.
SSH_KEY_RE = re.compile(r"(ssh-(?:rsa|ed25519|dss)|ecdsa-sha2-\S+)\s+\S+(\s+\S+)?")
MAC_RE = re.compile(r"\b(?:[0-9A-Fa-f]{2}:){5}[0-9A-Fa-f]{2}\b")
# IPv6 addresses and prefixes assigned to the captured account's machines.
IPV6_RE = re.compile(r"\b(?:[0-9A-Fa-f]{0,4}:){2,7}[0-9A-Fa-f]{0,4}(?:/\d{1,3})?\b")
IPV4_RE = re.compile(r"\b(?:\d{1,3}\.){3}\d{1,3}(?:/\d{1,2})?\b")
PHONE_RE = re.compile(r"\+?84[\s.]?\d{8,10}")
MAX_ITEMS = 2          # keep arrays short: a sample, not a data dump
MAX_KEYS = 20          # some endpoints return whole translation tables
MAX_STRING = 300

# Literal replacements supplied with --scrub-file. Everything account-specific lives
# there and never in this file: owned hostnames, the account holder's name, and the
# record ids (service, domain, invoice, ticket, VM) that would otherwise identify the
# account whose responses were captured.
EXTRA_SCRUB: dict[str, str] = {}


def scrub_text(text: str) -> str:
    # Normalise line endings: CRLF from live responses would otherwise land in the
    # generated docs and make them differ between checkouts.
    text = text.replace("\r\n", "\n").replace("\r", "\n")
    for literal, replacement in EXTRA_SCRUB.items():
        text = text.replace(literal, replacement)
    text = PANEL_LINK_RE.sub("<panel-link>", text)
    text = SSH_KEY_RE.sub("ssh-ed25519 AAAA<public-key> user@example.com", text)
    text = MAC_RE.sub("00:00:5E:00:53:00", text)
    text = IPV6_RE.sub("2001:db8::1", text)
    text = EMAIL_RE.sub("user@example.com", text)
    text = IPV4_RE.sub("203.0.113.10", text)
    text = PHONE_RE.sub("+84.900000000", text)
    if len(text) > MAX_STRING:
        text = text[:MAX_STRING] + "…"
    return text


def scrub_key(key: str) -> str:
    """Record ids also show up as object keys (`{"100001": [...]}`)."""
    return EXTRA_SCRUB.get(key, key)


def scrub_number(value: Any) -> Any:
    """…and as bare integers (`"domain_id": 500001`)."""
    replacement = EXTRA_SCRUB.get(str(value))
    if replacement is None:
        return value
    return int(replacement) if str(replacement).isdigit() else replacement


def sanitize(value: Any, key: str = "") -> Any:
    lowered = key.lower()
    if lowered in SECRET_KEYS:
        return "<redacted>"
    if lowered in IDENTITY_KEYS and not isinstance(value, (dict, list)):
        return PLACEHOLDER.get(lowered, "<redacted>")

    if isinstance(value, dict):
        items = list(value.items())
        result = {scrub_key(k): sanitize(v, k) for k, v in items[:MAX_KEYS]}
        if len(items) > MAX_KEYS:
            result["…"] = f"{len(items) - MAX_KEYS} more key(s)"
        return result
    if isinstance(value, list):
        trimmed = value[:MAX_ITEMS]
        result = [sanitize(item, key) for item in trimmed]
        if len(value) > MAX_ITEMS:
            result.append(f"… {len(value) - MAX_ITEMS} more item(s)")
        return result
    if isinstance(value, str):
        return scrub_text(value)
    if isinstance(value, int) and not isinstance(value, bool):
        return scrub_number(value)
    return value


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument("directories", nargs="+")
    parser.add_argument("-o", "--out", default="spec/response-samples.json")
    parser.add_argument(
        "--scrub-file",
        help="JSON object of {literal: replacement} applied to every string, key and path.",
    )
    args = parser.parse_args()

    if args.scrub_file:
        with open(args.scrub_file, encoding="utf-8") as handle:
            EXTRA_SCRUB.update(json.load(handle))

    samples: Dict[str, Any] = {}
    for directory in args.directories:
        path = os.path.join(directory, "responses.json")
        if not os.path.exists(path):
            continue
        with open(path, encoding="utf-8") as handle:
            captured = json.load(handle)
        for key, result in captured.items():
            # Keep successes only: an error body documents a rejection, not the
            # shape callers should expect from a working request.
            if result.get("status") != 200 or result.get("body") is None or result.get("error"):
                continue
            method, _, request_path = key.partition(" ")
            # Sweep keys carry disambiguating suffixes ("#2", " (legacy)", " (1.2.3.4)").
            request_path = request_path.split(" ")[0].split("#")[0]
            clean_path = scrub_text(request_path.split("?")[0])
            samples[f"{method} {clean_path}"] = {
                "method": method,
                "path": clean_path,
                "status": result["status"],
                "sample": sanitize(result["body"]),
            }

    os.makedirs(os.path.dirname(args.out) or ".", exist_ok=True)
    with open(args.out, "w", encoding="utf-8") as handle:
        json.dump(samples, handle, ensure_ascii=False, indent=1)
        handle.write("\n")
    print(f"{len(samples)} sanitised samples -> {args.out}")


if __name__ == "__main__":
    main()
