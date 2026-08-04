"""Emit the API-contract documentation from the catalog and the live response samples."""
from __future__ import annotations

import json
import os
import re
from typing import Any, Dict, List, Optional

from . import catalog as cat

# Order the chapters the way a reader discovers the API.
GROUP_ORDER = [
    "auth", "account", "billing", "support", "domains", "dns", "services", "cpanel",
    "vms", "cart", "certificates", "affiliate", "security", "phone", "location", "languages",
    "ekyc", "tinosite", "tinomail", "usageMonitor",
]
MAX_CHAPTER_LINES = 750     # split a group across files rather than exceed this
MAX_SAMPLE_LINES = 45       # a sample should show the shape, not dump the data


def _sample_index(samples: Dict[str, Any]) -> List[tuple]:
    return [(entry["method"], entry["path"], entry["sample"]) for entry in samples.values()]


def find_sample(operation: Dict[str, Any], index: List[tuple]) -> Optional[Any]:
    """Match a concrete captured path back to its path template."""
    segments = operation["path"].split("/")
    pattern = "/".join("[^/]+" if s.startswith("{") and s.endswith("}") else re.escape(s) for s in segments)
    compiled = re.compile(f"^{pattern}$")
    for method, path, sample in index:
        if method == operation["method"] and compiled.match(path):
            return sample
    return None


def _param_table(rows: List[Dict[str, Any]], where: str) -> List[str]:
    if not rows:
        return []
    lines = ["| Name | In | Type | Required | Description |", "| --- | --- | --- | --- | --- |"]
    for row in rows:
        description = (row.get("description") or "").replace("\n", " ").replace("|", "\\|").strip()
        if row.get("enum"):
            description += " One of: " + ", ".join(f"`{v}`" for v in row["enum"])
        if row.get("default") is not None:
            description += f" Default: `{row['default']}`."
        lines.append(
            f"| `{row['name']}` | {where} | {row.get('type') or 'string'} | "
            f"{'yes' if row.get('required') else 'no'} | {description.strip() or '—'} |"
        )
    return lines


def _body_table(operation: Dict[str, Any]) -> List[str]:
    fields = cat.body_fields(operation)
    if not fields:
        return []
    lines = ["| Field | Type | Required | Description |", "| --- | --- | --- | --- |"]
    for field in fields:
        description = (field.get("description") or "").replace("\n", " ").replace("|", "\\|").strip()
        if field.get("enum"):
            description += " One of: " + ", ".join(f"`{v}`" for v in field["enum"])
        lines.append(
            f"| `{field['name']}` | {field.get('type') or 'string'} | "
            f"{'yes' if field.get('required') else 'no'} | {description or '—'} |"
        )
    return lines


def _example_body(operation: Dict[str, Any]) -> Optional[str]:
    body = operation.get("body") or {}
    if body.get("example"):
        return json.dumps(body["example"], ensure_ascii=False, indent=2)
    fields = cat.body_fields(operation)
    if not fields:
        return None
    example = {}
    for field in fields:
        if field.get("example") is not None:
            example[field["name"]] = field["example"]
        elif field.get("enum"):
            example[field["name"]] = field["enum"][0]
        elif field.get("type") in ("integer", "number"):
            example[field["name"]] = 0
        elif field.get("type") == "boolean":
            example[field["name"]] = True
        elif field.get("type") == "array":
            example[field["name"]] = []
        elif field.get("type") == "object":
            example[field["name"]] = {}
        else:
            example[field["name"]] = f"<{field['name']}>"
    return json.dumps(example, ensure_ascii=False, indent=2)


def _sdk_snippets(operation: Dict[str, Any]) -> List[str]:
    group, name = operation["group"], operation["name"]
    params = cat.path_params(operation)
    py_args = [cat.python_arg(p["name"]) for p in params]
    js_args = [cat.js_arg(p["name"]) for p in params]
    if cat.has_body(operation) and cat.body_fields(operation):
        first = cat.body_fields(operation)[0]["name"]
        py_args.append(f"{cat.python_arg(first)}=...")   # keyword fields build the payload
        js_args.append("{ " + f"{first}: ... " + "}")
    php_args = [f"${cat.php_arg(p['name'])}" for p in params]
    if cat.has_body(operation) and cat.body_fields(operation):
        php_args.append("['" + cat.body_fields(operation)[0]["name"] + "' => ...]")

    return [
        "```python",
        f"client.{cat.snake(group)}.{cat.python_method(name)}({', '.join(py_args)})",
        "```",
        "```javascript",
        f"await client.{cat.camel(group)}.{cat.camel(name)}({', '.join(js_args)});",
        "```",
        "```php",
        f"$client->{cat.camel(group)}->{cat.camel(name)}({', '.join(php_args)});",
        "```",
    ]


def _operation_section(operation: Dict[str, Any], sample: Optional[Any]) -> List[str]:
    badges = ["Bearer token" if operation.get("auth") else "Public"]
    badges.append("verified live" if operation.get("verified") == "live" else "spec only")
    if operation.get("deprecated"):
        badges.append("**deprecated**")

    lines = [
        f"### `{operation['id']}`",
        "",
        f"`{operation['method']} {operation['path']}` — {' · '.join(badges)}",
        "",
    ]
    summary = (operation.get("summary") or "").strip()
    description = (operation.get("description") or "").strip()
    if summary:
        lines += [f"**{summary}**", ""]
    if description and description.lower() != summary.lower():
        lines += [description, ""]
    if operation.get("notes"):
        lines += [f"> **Note.** {operation['notes']}", ""]

    param_rows = _param_table(cat.path_params(operation), "path")
    query_rows = _param_table(operation.get("query") or [], "query")
    if param_rows or query_rows:
        lines.append("**Parameters**")
        lines.append("")
        if param_rows:
            lines += param_rows + [""]
        if query_rows:
            lines += query_rows + [""]

    body_rows = _body_table(operation)
    if body_rows:
        lines += ["**Request body**", ""] + body_rows + [""]
        example = _example_body(operation)
        if example:
            lines += ["```json", example, "```", ""]
    elif cat.has_body(operation):
        lines += ["**Request body** — none documented; any JSON object is forwarded as-is.", ""]

    lines.append("**Response** `200`")
    lines.append("")
    if sample is not None:
        rendered = json.dumps(sample, ensure_ascii=False, indent=1).split("\n")
        truncated = len(rendered) > MAX_SAMPLE_LINES
        if truncated:
            rendered = rendered[:MAX_SAMPLE_LINES] + [f"  … {len(rendered) - MAX_SAMPLE_LINES} more line(s)"]
        lines += [
            "<details><summary>Live sample (values redacted, long arrays trimmed)</summary>",
            "",
            "```json",
            "\n".join(rendered),
            "```",
            "",
            "</details>",
            "",
        ]
    else:
        lines += [
            "_Not captured live — this endpoint changes state, or it needs data the "
            "documentation account does not have. Request shape above comes from the API "
            "specification; the response is a JSON object, and failures follow the standard "
            "error envelope described in [conventions](../conventions.md)._",
            "",
        ]

    lines += ["**SDK**", ""] + _sdk_snippets(operation) + ["", "---", ""]
    return lines


def _chapter(group: str, operations: List[Dict[str, Any]], index: List[tuple], part: int, parts: int) -> List[str]:
    title = cat.GROUP_TITLES.get(group, group)
    heading = f"# {title}" + (f" (part {part}/{parts})" if parts > 1 else "")
    live = sum(1 for op in operations if op.get("verified") == "live")
    lines = [
        heading,
        "",
        f"SDK namespace: `client.{cat.snake(group)}` (Python) · `client.{cat.camel(group)}` (Node.js, PHP).",
        "",
        f"{len(operations)} operation(s) in this chapter, {live} with a captured live response.",
        "",
        "| Method | Path | SDK | Auth |",
        "| --- | --- | --- | --- |",
    ]
    for operation in operations:
        auth = "Bearer" if operation.get("auth") else "public"
        lines.append(
            f"| `{operation['method']}` | `{operation['path']}` | "
            f"[`{operation['name']}`](#{operation['id'].replace('.', '').lower()}) | {auth} |"
        )
    lines.append("")
    lines.append("---")
    lines.append("")
    for operation in operations:
        lines.extend(_operation_section(operation, find_sample(operation, index)))
    return lines


def _rendered_lines(section: List[str]) -> int:
    """Count real output lines: a JSON block is one list entry holding many newlines."""
    return "\n".join(section).count("\n") + 1


def _pack(operations: List[Dict[str, Any]], index: List[tuple]) -> List[List[Dict[str, Any]]]:
    """Split a group into files small enough to stay under MAX_CHAPTER_LINES.

    Sections vary a lot in size — a VM listing sample is far longer than a
    two-field POST — so pack by rendered length rather than by operation count.
    """
    budget = MAX_CHAPTER_LINES - 12 - len(operations)   # header plus the index table
    chunks: List[List[Dict[str, Any]]] = [[]]
    used = 0
    for operation in operations:
        size = _rendered_lines(_operation_section(operation, find_sample(operation, index)))
        if chunks[-1] and used + size > budget:
            chunks.append([])
            used = 0
        chunks[-1].append(operation)
        used += size
    return chunks


def emit(catalog: Dict[str, Any], samples: Dict[str, Any], root: str) -> List[str]:
    grouped = cat.by_group(catalog)
    index = _sample_index(samples)
    out_dir = os.path.join(root, "docs", "api-contract")
    os.makedirs(out_dir, exist_ok=True)
    written: List[str] = []
    chapters: List[tuple] = []

    ordered = [g for g in GROUP_ORDER if g in grouped] + [g for g in sorted(grouped) if g not in GROUP_ORDER]
    for number, group in enumerate(ordered, start=1):
        operations = sorted(grouped[group], key=lambda op: (op["path"], op["method"]))
        chunks = _pack(operations, index)
        for part, chunk in enumerate(chunks, start=1):
            suffix = "" if len(chunks) == 1 else f"-part-{part}"
            filename = f"{number:02d}-{cat.snake(group).replace('_', '-')}{suffix}.md"
            path = os.path.join(out_dir, filename)
            with open(path, "w", encoding="utf-8") as handle:
                handle.write("\n".join(_chapter(group, chunk, index, part, len(chunks))).rstrip() + "\n")
            written.append(path)
            chapters.append((group, filename, len(chunk), part, len(chunks)))

    written.append(_write_index(catalog, grouped, chapters, index, out_dir))
    return written


def _write_index(catalog, grouped, chapters, index, out_dir) -> str:
    total = len(catalog["operations"])
    live = sum(1 for op in catalog["operations"] if op.get("verified") == "live")
    lines = [
        "# Tino UserAPI — endpoint reference",
        "",
        f"Base URL: `{catalog['baseUrl']}`",
        "",
        f"{total} operations across {len(grouped)} resource groups. "
        f"{live} were called against the live API and carry a captured response sample; "
        f"the rest are documented from the API specification and marked *spec only*.",
        "",
        "See [../getting-started.md](../getting-started.md) for authentication and "
        "[../conventions.md](../conventions.md) for pagination, error handling and encoding rules.",
        "",
        "## Chapters",
        "",
        "| Chapter | Group | Operations |",
        "| --- | --- | --- |",
    ]
    for group, filename, count, part, parts in chapters:
        title = cat.GROUP_TITLES.get(group, group) + (f" (part {part}/{parts})" if parts > 1 else "")
        lines.append(f"| [{title}]({filename}) | `{group}` | {count} |")

    lines += ["", "## All endpoints", "",
              "| Method | Path | SDK method | Auth | Verified |",
              "| --- | --- | --- | --- | --- |"]
    for operation in sorted(catalog["operations"], key=lambda op: (op["path"], op["method"])):
        lines.append(
            f"| `{operation['method']}` | `{operation['path']}` | `{operation['id']}` | "
            f"{'Bearer' if operation.get('auth') else 'public'} | "
            f"{'live' if operation.get('verified') == 'live' else 'spec'} |"
        )
    path = os.path.join(out_dir, "README.md")
    with open(path, "w", encoding="utf-8") as handle:
        handle.write("\n".join(lines) + "\n")
    return path
