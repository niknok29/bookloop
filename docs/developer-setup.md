# Developer setup

Requirements: PHP 8.4+, Composer 2, Node 20+, npm, and PostgreSQL 15+. Copy `.env.example` to `.env`, set `DB_CONNECTION=pgsql` and credentials, then run:

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
php artisan migrate --seed
npm run build
php artisan test
php artisan route:list
```

For local UI use `php artisan serve`. If PostgreSQL is unavailable, use SQLite for smoke tests by changing `.env`. Clear cached config with `php artisan optimize:clear` when configuration changes.
