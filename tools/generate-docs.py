#!/usr/bin/env python3
"""Generate docs/api-contract/ from the catalog and the sanitised response samples.

Usage:
    python3 tools/generate-docs.py
"""
from __future__ import annotations

import argparse
import json
import os
import sys

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.dirname(HERE)
sys.path.insert(0, HERE)

from sdkgen import catalog as cat  # noqa: E402
from sdkgen import docs_emitter  # noqa: E402


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument("--catalog", default=os.path.join(ROOT, "spec", "tino-userapi-catalog.json"))
    parser.add_argument("--samples", default=os.path.join(ROOT, "spec", "response-samples.json"))
    args = parser.parse_args()

    data = cat.load(args.catalog)
    samples = {}
    if os.path.exists(args.samples):
        with open(args.samples, encoding="utf-8") as handle:
            samples = json.load(handle)

    written = docs_emitter.emit(data, samples, ROOT)
    covered = sum(1 for op in data["operations"] if op.get("verified") == "live")
    print(f"{len(written)} documentation files, {len(data['operations'])} operations "
          f"({covered} with a live response sample)")


if __name__ == "__main__":
    main()
