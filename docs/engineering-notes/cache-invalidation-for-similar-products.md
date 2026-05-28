# Cache Invalidation For Similar Products

## Problem

Recommendation cache invalidation is harder than "clear cache" because the output depends on both the current product and the candidate products around it.

## Context

Changing one product attribute can affect its own signature and its usefulness as a candidate for other products.

## Constraint

Invalidation should be accurate enough to avoid stale recommendations but not so broad that every catalog update rebuilds everything.

## Decision

Use fingerprints and candidate snapshots:

- cache keys include the source product signature;
- candidate scoring can be reused when fingerprints are unchanged;
- rebuild locks prevent traffic from triggering duplicate refreshes.

## Tradeoff

Fingerprint-based invalidation is more complex than one global cache key. It reduces unnecessary rebuilds and makes staleness easier to reason about.

## Failure Mode

The failure is either stale recommendations forever or global rebuilds that create a traffic spike after imports.

## What I Would Improve Next

Track candidate fingerprint changes separately from source product changes.

