# Request Lifecycle

The recommendation block is part of the product detail page critical path. It should behave like a bounded read path, not a live catalog scan.

```mermaid
flowchart TD
    A[PDP render] --> B[Build safe product signature]
    B --> C[Fingerprint signature]
    C --> D{Candidate cache hit?}
    D -->|yes| E[Return cached candidates]
    D -->|no| F{Rebuild lock available?}
    F -->|no| G[Return fallback set]
    F -->|yes| H[Score bounded candidate set]
    H --> I[Store candidate snapshot]
    I --> E
    E --> J[Render within budget]
    G --> J
```

## Operating Notes

- The PDP should not scan the full catalog during normal render.
- Cache keys should include product-signature fingerprints.
- Invalidation should be planned around catalog changes, not only global cache clears.
- A safe fallback is better than delaying the PDP while recommendations rebuild.

