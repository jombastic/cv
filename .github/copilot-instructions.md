<!-- Repository-specific Copilot instructions (concise, actionable) -->
# Copilot / AI assistant instructions for this repo

This file contains concise, repository-specific guidance to help AI coding agents be productive immediately.

- **Project type & versions:** Laravel app (Laravel v12), PHP ^8.2, uses Vite for assets. See `composer.json` and `.cursor/rules/laravel-boost.mdc` for exact tool versions.

- **Big picture:** This is a standard Laravel application skeleton. Key runtime pieces:
  - Backend: `app/` (models, controllers). Routes defined in `routes/web.php` and `routes/console.php`.
  - Bootstrap & providers: `bootstrap/app.php` and `bootstrap/providers.php` register middleware, exceptions and providers (Laravel 12 structure).
  - Database: migrations in `database/migrations`, model factories in `database/factories`.
  - Frontend: Vite + `resources/js` and `resources/css`, build via `npm run build` / `npm run dev`.

- **Common developer workflows / commands**
  - Install & setup (full): run `composer install` then `npm install`, copy `.env` from `.env.example`, `php artisan key:generate`, and `php artisan migrate` (a `composer` script `setup` exists that automates this).
  - Start dev environment: `composer run dev` or use `npm run dev` + `php artisan serve`. See `composer.json` `dev` script which uses `concurrently`.
  - Run tests: `php artisan test` (Pest v4 is used). To run single file: `php artisan test tests/Feature/ExampleTest.php`.
  - Lint/format: run `vendor/bin/pint` (project expects Pint to be run before finalizing changes).
  - Build assets: `npm run build` (resolves Vite manifest errors).

- **Testing conventions**
  - Tests are written with Pest (see `tests/Feature` and `tests/Unit`). Use `php artisan make:test --pest {Name}` to create new tests.
  - Use factories in tests (check `database/factories/UserFactory.php`). Prefer `$this->faker` or `fake()` consistent with existing tests.
  - Prefer expressive Pest assertions (e.g., `assertForbidden`, `assertNotFound`, `assertSuccessful`).

- **Laravel-specific patterns found in repo**
  - Models may use a `casts()` method rather than `$casts` property (see `app/Models/User.php`). Follow that pattern when adding new models.
  - Use Form Request classes for validation (search sibling controllers/requests to match style).
  - Prefer Eloquent relationships and eager-loading to avoid N+1 queries.

- **Project-specific developer notes / gotchas**
  - The repo contains Laravel Boost and Herd guidelines in `.cursor/rules/laravel-boost.mdc`. Respect its rules: use `php artisan` make commands, use the Boost tools where available, and follow code style hints in that file.
  - Herd serves the app using a `.test` local domain pattern. Do not attempt to start an HTTP server externally; the environment expects Herd. When sharing URLs, prefer project-local URLs.
  - Vite manifest errors are common when assets aren't built — run `npm run build` or `composer run dev` if views complain about missing assets.

- **Where to look for examples / authoritative patterns**
  - `app/Models/User.php` — model casting pattern and `HasFactory` usage.
  - `database/migrations/0001_01_01_000000_create_users_table.php` — migration style and existing tables.
  - `composer.json` — project scripts (`setup`, `dev`, `test`) that automate common tasks.
  - `.cursor/rules/laravel-boost.mdc` — project-specific AI and coding conventions; use it as the primary source for agent behavior.

- **When editing code**
  - Follow sibling files' style exactly (naming, constructor promotion, return types). Pint will be run locally: run `vendor/bin/pint --dirty` before finalizing changes.
  - Use `php artisan make:` generators with `--no-interaction` for new classes so scaffolding matches project conventions.
  - When changing database columns, include all attributes in migration (Laravel 11+ requirement in this project).

- **Integration points**
  - Background jobs: `queue` uses Laravel queues; composer dev script listens via `php artisan queue:listen` in dev.
  - Frontend integration: `vite` builds assets referenced by Blade templates; ensure `manifest.json` exists after build.

- **Example quick tasks for agents (concrete examples)**
  - Add a new API resource `Article`:
    1. `php artisan make:model Article -m --factory`
    2. Implement `casts()` on model following `User.php` pattern.
    3. Create a Form Request via `php artisan make:request StoreArticleRequest`.
    4. Add tests using Pest: `php artisan make:test --pest ArticleTest` and use factories.

If any part of this file is unclear or you'd like more detail (for example, explicit examples of Form Requests, factories, or a recommended Pint configuration), tell me which section to expand. I can iterate quickly.
