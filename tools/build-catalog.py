#!/usr/bin/env python3
"""Build the canonical Tino UserAPI catalog from the upstream Swagger 2.0 file.

The catalog (spec/tino-userapi-catalog.json) is the single source of truth used to
generate both the API-contract documentation and the resource layer of every SDK,
so all three languages stay in sync.

Usage:
    python3 tools/build-catalog.py <swagger.json> [-o spec/tino-userapi-catalog.json]
"""
from __future__ import annotations

import argparse
import json
import os
import re
import sys

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.dirname(HERE)

# Endpoints that never carry an Authorization header.
PUBLIC_PATHS = {
    "/login", "/login-otp", "/verify-login-otp", "/login-sso", "/token",
    "/signup", "/checkemail", "/password/forgot", "/password/passreset",
    "/status", "/submit_contactform",
}

# (regex on path, group). First match wins — order matters.
# Query string accepted by every paginated list endpoint (verified live).
PAGING_QUERY = [
    {"name": "page", "type": "integer", "required": False, "default": 0, "enum": None,
     "description": "Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current."},
    {"name": "perpage", "type": "integer", "required": False, "default": None, "enum": None,
     "description": "Rows per page. Defaults to the account's RecordsPerPage setting."},
    {"name": "orderby", "type": "string", "required": False, "default": None, "enum": None,
     "description": "Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`."},
    {"name": "filter", "type": "object", "required": False, "default": None, "enum": None,
     "description": "Endpoint-specific filters, serialised as filter[key]=value."},
]

GROUP_RULES = [
    (r"^/(login|logout|revoke|token|signup|checkemail|verify-login-otp|password/|verification/)", "auth"),
    (r"^/ekyc/", "ekyc"),
    (r"^/domain/[^/]+/documents", "ekyc"),
    (r"^/domain/documents/", "ekyc"),
    (r"^/domain/vnnic/", "ekyc"),
    (r"^/(domain|domains|whois)", "domains"),
    (r"^/certificates?", "certificates"),
    (r"^/service/[^/]+/dns", "dns"),
    (r"^/dns", "dns"),
    (r"^/service/[^/]+/vms", "vms"),
    (r"^/service/cpanel2/", "cpanel"),
    (r"^/service/[^/]+/tinomail", "tinomail"),
    (r"^/tinosite/", "tinosite"),
    (r"^/services?\b", "services"),
    (r"^/(category|categories|cart/|v2/cart/|order|quote)", "cart"),
    (r"^/(balance|invoice|invoices|estimate|estimates|billing/|addfunds|currencies|payment)", "billing"),
    (r"^/(tickets?|news|knowledgebase)", "support"),
    (r"^/languages", "languages"),
    (r"^/affiliates?", "affiliate"),
    (r"^/security", "security"),
    (r"^/location/", "location"),
    (r"^/usage-monitor/", "usageMonitor"),
    (r"^/(details|clientarea|contact|contacts|notifications|logs|downloads?|changeowner|status)", "account"),
]


def group_of(path: str) -> str:
    for pattern, group in GROUP_RULES:
        if re.match(pattern, path):
            return group
    return "misc"


def camel(text: str) -> str:
    parts = re.split(r"[^a-zA-Z0-9]+", text)
    parts = [p for p in parts if p]
    if not parts:
        return "call"
    head = parts[0]
    head = head[0].lower() + head[1:]
    return head + "".join(p[0].upper() + p[1:] for p in parts[1:])


def clean_text(text: str) -> str:
    """Normalise CRLF and stray carriage returns out of spec prose.

    The upstream file mixes line endings; leaving them in makes generated files
    differ between checkouts and breaks the "generated code is current" CI check.
    """
    return text.replace("\r\n", "\n").replace("\r", "\n")


def clean_path(path: str) -> str:
    """Normalise malformed paths present in the upstream spec."""
    path = path.replace("\t", "").replace("\r", "").replace("\n", "")
    path = re.sub(r"^/GET /", "/", path)     # spec has "/GET /location/..." typos
    path = re.sub(r"\s+", "", path)
    if not path.startswith("/"):
        path = "/" + path
    return path


def body_schema(param: dict) -> dict | None:
    schema = param.get("schema") or {}
    props = schema.get("properties") or {}
    if not props:
        return None
    fields = []
    for name, meta in props.items():
        fields.append({
            "name": name,
            "type": meta.get("type", "string"),
            "required": name in (schema.get("required") or []),
            "description": clean_text(meta.get("description") or "").strip(),
            "enum": meta.get("enum"),
            "default": meta.get("default"),
            "example": meta.get("example"),
        })
    return {"fields": fields, "example": schema.get("example")}


def build(swagger: dict) -> dict:
    operations = []
    used_names: dict[str, set] = {}
    for raw_path, methods in swagger.get("paths", {}).items():
        path = clean_path(raw_path)
        for verb, op in methods.items():
            if verb not in ("get", "post", "put", "delete", "patch"):
                continue
            group = group_of(path)
            name = camel(op.get("operationId") or f"{verb}_{path}")
            seen = used_names.setdefault(group, set())
            if name in seen:
                name = f"{name}{verb.capitalize()}"
            seen.add(name)

            path_params, query_params, body = [], [], None
            for param in op.get("parameters") or []:
                where = param.get("in")
                if where == "body":
                    body = body_schema(param)
                    continue
                entry = {
                    "name": param.get("name"),
                    "type": param.get("type", "string"),
                    "required": bool(param.get("required")),
                    "description": clean_text(param.get("description") or "").strip(),
                    "enum": param.get("enum"),
                    "default": param.get("default"),
                }
                (path_params if where == "path" else query_params).append(entry)

            # Path placeholders missing from the parameter list still need arguments.
            declared = {p["name"] for p in path_params}
            for placeholder in re.findall(r"\{(\w+)\}", path):
                if placeholder not in declared:
                    path_params.append({
                        "name": placeholder, "type": "string", "required": True,
                        "description": "", "enum": None, "default": None,
                    })
            order = [p for p in re.findall(r"\{(\w+)\}", path)]
            path_params.sort(key=lambda p: order.index(p["name"]) if p["name"] in order else 99)

            operations.append({
                "id": f"{group}.{name}",
                "group": group,
                "name": name,
                "method": verb.upper(),
                "path": path,
                "auth": path not in PUBLIC_PATHS,
                "tag": (op.get("tags") or ["Untagged"])[0].split("\n")[0].strip(),
                "summary": clean_text(op.get("summary") or "").strip(),
                "description": clean_text(op.get("description") or "").strip(),
                "pathParams": path_params,
                "query": query_params,
                "body": body,
                "verified": "spec",
            })
    operations.sort(key=lambda o: (o["group"], o["path"], o["method"]))
    info = swagger.get("info") or {}
    return {
        "name": "tino-userapi",
        "title": "Tino UserAPI",
        "version": info.get("version") or "1.0.0",
        "baseUrl": "https://api.tino.vn",
        "source": "API specification, production usage and live verification against https://api.tino.vn",
        "operations": operations,
    }


def apply_corrections(catalog: dict, corrections: dict) -> dict:
    ops = {op["id"]: op for op in catalog["operations"]}

    for op_id in corrections.get("remove", []):
        ops.pop(op_id, None)

    # Rename first so every later section can address operations by their final id.
    for op_id, new_id in (corrections.get("rename") or {}).items():
        if op_id in ops:
            op = ops.pop(op_id)
            op["id"] = new_id
            op["group"], op["name"] = new_id.split(".", 1)
            ops[new_id] = op
        else:
            print(f"  ! rename source not found: {op_id}", file=sys.stderr)

    for op_id, patch in (corrections.get("patch") or {}).items():
        if op_id in ops:
            ops[op_id].update(patch)
        else:
            print(f"  ! patch target not found: {op_id}", file=sys.stderr)

    for extra in corrections.get("add", []):
        extra.setdefault("verified", "live")
        extra.setdefault("auth", True)
        extra.setdefault("pathParams", [])
        extra.setdefault("query", [])
        extra.setdefault("body", None)
        extra.setdefault("tag", extra["group"])
        ops[extra["id"]] = extra

    for op_id in corrections.get("verifiedLive", []):
        if op_id in ops:
            ops[op_id]["verified"] = "live"
        else:
            print(f"  ! verifiedLive target not found: {op_id}", file=sys.stderr)

    # List endpoints all accept the same paging/sorting/filtering query string.
    for op_id in corrections.get("paginated", []):
        if op_id not in ops:
            print(f"  ! paginated target not found: {op_id}", file=sys.stderr)
            continue
        op = ops[op_id]
        op["paginated"] = True
        present = {q["name"] for q in op["query"]}
        for extra in PAGING_QUERY:
            if extra["name"] not in present:
                op["query"].append(dict(extra))

    catalog["operations"] = sorted(ops.values(), key=lambda o: (o["group"], o["path"], o["method"]))
    return catalog


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument("swagger")
    parser.add_argument("-o", "--out", default=os.path.join(ROOT, "spec", "tino-userapi-catalog.json"))
    parser.add_argument("-c", "--corrections", default=os.path.join(HERE, "catalog-corrections.json"))
    args = parser.parse_args()

    # The upstream file contains raw control characters, so parse it leniently.
    swagger = json.loads(open(args.swagger, encoding="utf-8", errors="replace").read(), strict=False)
    catalog = build(swagger)

    if os.path.exists(args.corrections):
        catalog = apply_corrections(catalog, json.load(open(args.corrections, encoding="utf-8")))

    os.makedirs(os.path.dirname(args.out), exist_ok=True)
    with open(args.out, "w", encoding="utf-8") as fh:
        json.dump(catalog, fh, ensure_ascii=False, indent=1)
        fh.write("\n")

    groups: dict[str, int] = {}
    for op in catalog["operations"]:
        groups[op["group"]] = groups.get(op["group"], 0) + 1
    print(f"{len(catalog['operations'])} operations -> {args.out}")
    for group, count in sorted(groups.items(), key=lambda kv: -kv[1]):
        print(f"  {group:14s} {count}")


if __name__ == "__main__":
    main()
