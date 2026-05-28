# Observability And Instrumentation

Recommendation observability should explain whether the block is helping or hurting the PDP render path.

## Measure

- candidate cache hit/miss rate;
- rebuild lock contention;
- scoring duration bucket;
- fallback rate;
- stale candidate age;
- render duration for the block;
- invalidation trigger count.

## Do Not Log Publicly

- private scoring weights;
- private merchandising rules;
- internal product IDs from production;
- raw catalog exports.

## Threshold Concepts

- fallback rate rising after catalog updates;
- scoring time exceeding render budget;
- cache misses clustering on popular products;
- stale candidates older than the intended freshness window.

## Debug Workflow

1. Check the product signature fingerprint.
2. Confirm whether a candidate snapshot exists.
3. Inspect rebuild lock behavior before tuning scoring.
4. Validate invalidation trigger coverage.
5. Prefer stale-safe fallback over live expensive queries.

