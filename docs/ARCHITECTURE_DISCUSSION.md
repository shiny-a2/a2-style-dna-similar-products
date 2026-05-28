# Architecture Discussion

The recommendation approach favors explainable signatures over opaque ranking. That is a compromise. It may be less sophisticated than ML-based ranking, but it is easier to operate inside WooCommerce and easier to cache safely.

The public samples keep scoring simple because the important engineering point is not the exact score; it is moving repeated scoring away from the render path.

## Open Questions

- How should imports invalidate fingerprints without rebuilding everything?
- Should stale candidates be shown while refresh runs in the background?
- Where should merchandising overrides live without weakening cache behavior?

