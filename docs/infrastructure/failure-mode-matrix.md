# Failure Mode Matrix

| Failure mode | Likely cause | Detection signal | Safe behavior | Recovery path | What not to do |
| --- | --- | --- | --- | --- | --- |
| Stale candidates | Missed invalidation trigger | Candidate age exceeds policy | Show stale-safe set or fallback | Rebuild affected product snapshot | Clear all caches under traffic |
| Expensive live fallback | Cache miss runs full scoring | PDP render delay | Return bounded fallback | Queue rebuild outside critical path | Scan full catalog on every miss |
| Invalid taxonomy mapping | Attribute changed or removed | Empty or odd candidate set | Degrade to fallback | Rebuild signatures for affected terms | Assume old mappings are valid |
| Cache invalidation miss | Product fingerprint not updated | Cache hit with outdated signature | Keep TTL and detect age | Fix fingerprint source | Add longer TTL to hide issue |
| PDP render delay | Scoring enters render path | Block render exceeds budget | Skip or fallback | Move scoring behind lock/snapshot | Optimize UI while query remains heavy |

