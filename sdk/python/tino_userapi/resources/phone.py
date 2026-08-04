"""Phone number verification.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class PhoneResource(Resource):
    """Phone number verification — 2 operations."""

    def request_otp(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Send a phone verification code

        POST /phone/otp — Bearer token required, from the API specification.

        Send a one-time code over Zalo ZNS to prove the account owner holds the SIM. Omit
        phonenumber to verify the number already on the account. Accounts that have already
        verified a number are refused with already_verified — change the number through PUT
        /details first, which clears the previous verification.

        Note: Delivery is ZNS only — there is no email fallback, because the point is to prove
        possession of the SIM. The code lasts 300 seconds, may be resent after 60 seconds, at
        most 3 times, and is destroyed after 5 wrong attempts.

        Body fields:
          - phonenumber (string): Number to verify. Defaults to the one on the account.
        """
        return self._call("POST", "/phone/otp", body=self._body(payload, fields))

    def verify(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Confirm a phone verification code

        POST /phone/verify — Bearer token required, from the API specification.

        Confirm the code sent by phone.requestOtp. On success the number is written to the
        profile when it changed, and ownership of it is claimed for this account. No new token
        is issued — the current session continues.

        Note: Returns {success, phone:{status, verified_at}}. A phone belongs to exactly one
        account: claiming is guarded by a unique index, so a race loses cleanly with
        phone_already_verified.

        Body fields:
          - otp (string, required): Six-digit code
        """
        return self._call("POST", "/phone/verify", body=self._body(payload, fields))
