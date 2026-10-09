# API contract

Future JSON endpoints use snake_case keys and named kebab-case routes. Success is `{ "data": {}, "meta": {} }`; validation failure is `{ "message": "...", "errors": { "field": ["..."] } }` with 422. Use 401, 403, 404 and 201 according to HTTP semantics. The foundation exposes the web UI only.
