# Known Limitations

- Public scoring weights are illustrative, not production merchandising logic.
- Cache invalidation is simplified.
- Candidate selection is bounded but not tuned for every catalog shape.
- No synthetic screenshots are included yet.

## Operational Edge Cases To Track

- Products with sparse attributes.
- Products with no price.
- Catalog imports that update many attributes at once.
- Cache rebuild lock expiry during high traffic.

