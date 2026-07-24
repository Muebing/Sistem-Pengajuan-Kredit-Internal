# AGENTS.md

## Project

Capella Multidana - Sistem Pengajuan Kredit. Laravel 13.8 prototype app (PHP 8.3+) for internal staff credit submission management. Vite 8 + Tailwind CSS 4 frontend. MySQL database.

## Architecture

- MVC pattern with Service class for business logic (`app/Services/PengajuanService.php`)
- Form Request validation (`app/Http/Requests/StorePengajuanRequest.php`)
- Resource Controller (`app/Http/Controllers/PengajuanController.php`)
- Route Model Binding with custom table name (`protected $table = 'pengajuan'`)
- Blade views in `resources/views/` with layout in `resources/views/layouts/app.blade.php`

## Commands

```bash
composer setup          # install + env + key + migrate + npm install + npm run build
composer dev            # artisan serve + queue:listen + pail + vite concurrently
composer test           # artisan config:clear && artisan test
npx laravel-pint        # code style fixer (no standalone script, run directly)
npx vite build          # rebuild frontend assets
```

## Testing

- PHPUnit 12.5 with Unit and Feature suites.
- Tests run against **MySQL** (`phpunit.xml` sets `DB_CONNECTION=mysql`, `DB_DATABASE=capella_multidana_test`).
- Run a single test: `php artisan test --filter=MethodName` or `vendor/bin/phpunit --filter=MethodName`.

## Code Style

- **Laravel Pint** (`laravel/pint`) handles PHP formatting. Run `./vendor/bin/pint` to fix.
- 4-space indent, LF line endings, UTF-8 (`.editorconfig`).
- No custom linting or static analysis tools configured.

## Vite / Frontend

- Entry points: `resources/css/app.css`, `resources/js/app.js`.
- `vite.config.js` uses the Bunny fonts plugin for Instrument Sans (weights 400/500/600).
- `storage/framework/views/**` is excluded from Vite file watching.
- `.npmrc` sets `ignore-scripts=true` — post-install scripts are suppressed.
- **Must run `npx vite build` before tests** — views use `@vite()` which requires `public/build/manifest.json`.

## Database

- MySQL database: `capella_multidana` (production), `capella_multidana_test` (tests).
- Table: `pengajuan` (singular, with `protected $table = 'pengajuan'` in model).
- Migrations: `database/migrations/`. Seeders: `database/seeders/`. Factories: `database/factories/`.
- `composer setup` runs `migrate --force` automatically.

## Business Rules

- Max monthly income for approval: Rp1,000,000 minimum.
- Max loan amount for approval: Rp200,000,000.
- Max tenor: 24 months.
- Max applications per customer: 3.
- Monthly bill = loan_amount / tenor (no interest).
- Status flow: pending → disetujui | ditolak.

## Dev Environment

- Windows + Laragon — artisan serve binds to `localhost` by default.
- `composer dev` runs 4 concurrent processes (server, queue, pail, vite) via `npx concurrently`.
- Queue is database-backed by default; `composer dev` starts a queue listener.
