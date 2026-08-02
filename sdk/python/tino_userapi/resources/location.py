"""Countries, states & cities.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class LocationResource(Resource):
    """Countries, states & cities — 8 operations."""

    def get_city_by_state_name_v2(self, name, **query: Any) -> Any:
        """Get city by State Name V2

        GET /location/state/city-v2/{name} — Bearer token required, verified against the live API.

        Path parameters:
          - name: State name
        """
        path = self._path("/location/state/city-v2/{name}", name=name)
        return self._call("GET", path, query=query)

    def list_all_cities(self, **query: Any) -> Any:
        """Get All citys

        GET /location/citys — no authentication required, verified against the live API.
        """
        return self._call("GET", "/location/citys", query=query, authenticated=False)

    def list_cities_by_state_id(self, id, **query: Any) -> Any:
        """Get city

        GET /location/state/{id}/city — no authentication required, verified against the live API.

        Path parameters:
          - id: State id
        """
        path = self._path("/location/state/{id}/city", id=id)
        return self._call("GET", path, query=query, authenticated=False)

    def list_cities_by_state_id_v2(self, id, **query: Any) -> Any:
        """Get city V2

        GET /location/state/{id}/city-v2 — no authentication required, verified against the live API.

        Path parameters:
          - id: State id
        """
        path = self._path("/location/state/{id}/city-v2", id=id)
        return self._call("GET", path, query=query, authenticated=False)

    def list_cities_by_state_name(self, name, **query: Any) -> Any:
        """Get city by State Name

        GET /location/state/city/{name} — no authentication required, verified against the live API.

        Path parameters:
          - name: State name
        """
        path = self._path("/location/state/city/{name}", name=name)
        return self._call("GET", path, query=query, authenticated=False)

    def list_countries(self, **query: Any) -> Any:
        """countries List

        GET /location/countries — no authentication required, verified against the live API.

        Return currencies details
        """
        return self._call("GET", "/location/countries", query=query, authenticated=False)

    def list_states(self, code, **query: Any) -> Any:
        """Get state

        GET /location/{code}/state — no authentication required, verified against the live API.

        Path parameters:
          - code: Country Code
        """
        path = self._path("/location/{code}/state", code=code)
        return self._call("GET", path, query=query, authenticated=False)

    def list_states_v2(self, code, **query: Any) -> Any:
        """Get state V2

        GET /location/{code}/state-v2 — no authentication required, verified against the live API.

        Path parameters:
          - code: Country Code
        """
        path = self._path("/location/{code}/state-v2", code=code)
        return self._call("GET", path, query=query, authenticated=False)
