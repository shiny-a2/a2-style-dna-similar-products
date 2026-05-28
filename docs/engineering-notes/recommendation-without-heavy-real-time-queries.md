# Recommendation Without Heavy Real-Time Queries

## Problem

Similar-products blocks are often added as UI features, but the expensive part is data selection. Scanning the catalog during every product page render is the wrong default.

## Context

The recommendation block sits on a critical route: the product detail page. If it is slow, it affects the page where buying intent is highest.

## Constraint

The block should not make PDP rendering depend on repeated live catalog scans.

## Decision

Move recommendation work into signatures and cached candidate snapshots:

- product attributes become a compact signature;
- candidates are scored outside the normal render path where possible;
- the block renders cached IDs;
- fallback behavior is acceptable when candidates are missing.

## Tradeoff

Cached recommendations may be slightly stale. Live recommendations may be more current but can make the page slower and less predictable.

## Failure Mode

The failure is a recommendation widget that improves discovery but quietly adds a slow query path to every PDP.

## What I Would Improve Next

Add a rebuild queue so expensive candidate refreshes happen in controlled batches.

