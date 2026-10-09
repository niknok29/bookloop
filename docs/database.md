# Database

PostgreSQL is the target. `books` stores bibliographic data; `book_copies` stores physical items; `stickers` maps codes to copies; `book_points` stores locations; `book_movements` is history; `wishlists` is unique per user/book; coin and XP transactions are append-only foundations. `public_id` is unique and location-independent.
