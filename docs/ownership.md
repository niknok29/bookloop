# Ownership and boundaries

| Developer | Ownership | Boundary |
|---|---|---|
| 1 | Auth, models, migrations, security, take/put | Emits domain events; does not own presentation |
| 2 | Blade/Livewire, design system, PWA/QR UX | Calls actions/services; no business rules in views |
| 3 | Wishlist matching, events/listeners, reminders, Coin/XP | Consumes movement events; transactions remain append-only |
| 4 | BookPoint CRUD, sticker generation/activation, add-book flow | Uses relationships and adds integration coverage |

Shared contracts are migrations, Actions/Services, Events, named routes and documented response envelopes.
