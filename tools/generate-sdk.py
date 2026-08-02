#!/usr/bin/env python3
"""Generate the resource layer of every Tino SDK from the canonical catalog.

The hand-written parts of each SDK (HTTP transport, auth, errors, client) live in
sdk/<language>/ and are never touched by this script. Only the per-endpoint
resource classes are generated, so all three languages expose the same surface.

Usage:
    python3 tools/generate-sdk.py [--catalog spec/tino-userapi-catalog.json]
                                  [--only python|nodejs|php]
"""
from __future__ import annotations

import argparse
import os
import sys

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.dirname(HERE)
sys.path.insert(0, HERE)

from sdkgen import catalog as cat  # noqa: E402
from sdkgen import node_emitter, php_emitter, python_emitter  # noqa: E402

EMITTERS = {
    "python": python_emitter.emit,
    "nodejs": node_emitter.emit,
    "php": php_emitter.emit,
}


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument("--catalog", default=os.path.join(ROOT, "spec", "tino-userapi-catalog.json"))
    parser.add_argument("--only", choices=sorted(EMITTERS), action="append")
    args = parser.parse_args()

    data = cat.load(args.catalog)
    targets = args.only or sorted(EMITTERS)

    total_operations = len(data["operations"])
    for target in targets:
        written = EMITTERS[target](data, ROOT)
        print(f"{target:8s} {len(written):3d} files, {total_operations} operations")


if __name__ == "__main__":
    main()
