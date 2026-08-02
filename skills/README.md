# Agent skills

[`tino-userapi/`](tino-userapi/SKILL.md) teaches an agent to integrate a project with
the Tino UserAPI through the official SDKs — when to reach for it, how to authenticate,
and the handful of API behaviours that break naive clients.

The format is the standard `SKILL.md` + `references/` layout, so the same directory works
in Paperclip, Claude Code and Codex.

## Install in Paperclip (opc.tino.vn)

**Through the UI** — *Company → Skills → Add skill*, then upload the `tino-userapi`
directory. The skill becomes available to every agent in the company; agents load the
full text only when the description matches what they are doing.

**Through the API:**

```bash
curl -X POST "$PAPERCLIP_API_URL/api/companies/$PAPERCLIP_COMPANY_ID/skills" \
  -H "Authorization: Bearer $PAPERCLIP_API_KEY" \
  -H 'Content-Type: application/json' \
  -d @- <<'JSON'
{
  "name": "tino-userapi",
  "source": "https://github.com/tinovn/tino-sdk/tree/main/skills/tino-userapi"
}
JSON
```

Check the field names against your Paperclip version — `GET /api/companies/{id}/skills`
shows the shape the running instance expects.

**Who should get it:** every coder, plus the Planner and the Product Manager so scoping
a Tino-facing feature starts from what the API can actually do. It is not needed by
Designer, Legal or Docs Writer.

## Install in Claude Code

```bash
git clone https://github.com/tinovn/tino-sdk.git
cp -r tino-sdk/skills/tino-userapi ~/.claude/skills/
```

Project-scoped instead: copy it to `.claude/skills/` inside the project.

## Install in Codex

```bash
cp -r tino-sdk/skills/tino-userapi ~/.codex/skills/
```

## Keeping it current

`references/resource-map.md` is generated from the catalog:

```bash
python3 tools/generate-skill-reference.py
```

Re-run it after `tools/build-catalog.py`, so the endpoint list an agent reads never drifts
from the endpoints the SDK actually exposes.
