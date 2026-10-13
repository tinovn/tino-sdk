"""Catalog loading plus the naming rules shared by all SDK emitters."""
from __future__ import annotations

import json
import re
from typing import Any, Dict, Iterable, List

# Human-readable titles for each resource group, reused in docs and SDK docstrings.
GROUP_TITLES = {
    "auth": "Authentication",
    "account": "Client area & account",
    "billing": "Billing, invoices & payments",
    "support": "Support tickets, news & knowledgebase",
    "domains": "Domain names",
    "dns": "DNS zones & records",
    "services": "Services (hosting, VPS, ...)",
    "cpanel": "cPanel service actions",
    "vms": "Cloud instances / virtual machines",
    "cart": "Catalogue, cart & orders",
    "certificates": "SSL certificates",
    "affiliate": "Affiliate programme",
    "security": "Account security (SSH keys, IP access)",
    "phone": "Phone number verification",
    "location": "Countries, states & cities",
    "languages": "Languages & translations",
    "ekyc": "Domain documents & eKYC",
    "tinosite": "TinoSite (managed WordPress)",
    "backorder": "Domain backorder auctions (.vn)",
    "tinomail": "TinoMail",
    "usageMonitor": "Proxmox2 usage monitor",
}

PYTHON_KEYWORDS = {
    "and", "as", "assert", "async", "await", "break", "class", "continue", "def", "del",
    "elif", "else", "except", "finally", "for", "from", "global", "if", "import", "in",
    "is", "lambda", "none", "nonlocal", "not", "or", "pass", "raise", "return", "try",
    "while", "with", "yield",
}

JS_KEYWORDS = {
    "delete", "new", "class", "default", "function", "return", "var", "let", "const",
    "import", "export", "switch", "case", "typeof", "instanceof", "void", "with",
}


def load(path: str) -> Dict[str, Any]:
    with open(path, encoding="utf-8") as handle:
        return json.load(handle)


def by_group(catalog: Dict[str, Any]) -> Dict[str, List[Dict[str, Any]]]:
    grouped: Dict[str, List[Dict[str, Any]]] = {}
    for operation in catalog["operations"]:
        grouped.setdefault(operation["group"], []).append(operation)
    for operations in grouped.values():
        operations.sort(key=lambda op: op["name"])
    return grouped


def snake(text: str) -> str:
    text = re.sub(r"([a-z0-9])([A-Z])", r"\1_\2", text)
    text = re.sub(r"[^a-zA-Z0-9]+", "_", text)
    return text.lower().strip("_")


def camel(text: str) -> str:
    parts = [p for p in re.split(r"[^a-zA-Z0-9]+", text) if p]
    if not parts:
        return "call"
    return parts[0][0].lower() + parts[0][1:] + "".join(p[0].upper() + p[1:] for p in parts[1:])


def pascal(text: str) -> str:
    parts = [p for p in re.split(r"[^a-zA-Z0-9]+", text) if p]
    return "".join(p[0].upper() + p[1:] for p in parts)


def python_method(name: str) -> str:
    return snake(name)


def python_arg(name: str) -> str:
    arg = snake(name)
    return arg + "_" if arg in PYTHON_KEYWORDS else arg


def js_arg(name: str) -> str:
    arg = camel(name)
    return arg + "_" if arg in JS_KEYWORDS else arg


def php_arg(name: str) -> str:
    return camel(name)


def path_params(operation: Dict[str, Any]) -> List[Dict[str, Any]]:
    return operation.get("pathParams") or []


def body_fields(operation: Dict[str, Any]) -> List[Dict[str, Any]]:
    body = operation.get("body") or {}
    return body.get("fields") or []


def has_body(operation: Dict[str, Any]) -> bool:
    return operation["method"] in ("POST", "PUT", "PATCH", "DELETE")


def doc_lines(operation: Dict[str, Any]) -> List[str]:
    """Build the shared documentation block for one operation."""
    lines: List[str] = []
    summary = operation.get("summary") or operation["name"]
    lines.append(summary)
    lines.append("")
    verified = "verified against the live API" if operation.get("verified") == "live" else "from the API specification"
    auth = "Bearer token required" if operation.get("auth") else "no authentication required"
    lines.append(f"{operation['method']} {operation['path']} — {auth}, {verified}.")

    if operation.get("deprecated"):
        lines.append("")
        lines.append("DEPRECATED — kept for compatibility; see the note below for the replacement.")

    description = (operation.get("description") or "").strip()
    if description and description.lower() != summary.lower():
        lines.append("")
        lines.extend(_wrap(description))

    if operation.get("notes"):
        lines.append("")
        lines.extend(_wrap("Note: " + operation["notes"]))

    for param in path_params(operation):
        if param.get("description"):
            lines.append("")
            break
    params = [p for p in path_params(operation) if p.get("description")]
    if params:
        lines.append("Path parameters:")
        for param in params:
            lines.append(f"  - {param['name']}: {param['description']}")

    query = operation.get("query") or []
    if query:
        lines.append("")
        lines.append("Query parameters:")
        for param in query:
            suffix = " (required)" if param.get("required") else ""
            description = param.get("description") or ""
            lines.append(f"  - {param['name']}{suffix}: {description}".rstrip(": "))

    fields = body_fields(operation)
    if fields:
        lines.append("")
        lines.append("Body fields:")
        for field in fields:
            bits = [field.get("type") or "string"]
            if field.get("required"):
                bits.append("required")
            if field.get("enum"):
                bits.append("one of " + ", ".join(str(v) for v in field["enum"]))
            description = (field.get("description") or "").replace("\n", " ").strip()
            lines.append(f"  - {field['name']} ({', '.join(bits)}): {description}".rstrip(": "))
    return lines


def _wrap(text: str, width: int = 88) -> List[str]:
    import textwrap
    out: List[str] = []
    for paragraph in text.split("\n"):
        paragraph = paragraph.strip()
        out.extend(textwrap.wrap(paragraph, width) or [""])
    return out


def indent(lines: Iterable[str], prefix: str) -> List[str]:
    return [(prefix + line).rstrip() for line in lines]
