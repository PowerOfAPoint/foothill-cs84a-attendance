# Copilot instructions for `foothill-cs84a-attendance`

Short, actionable guidance to help AI coding agents quickly be productive working on this PHP + MySQL app.

**Big picture**

- **Purpose:** Small PHP web app for registering and viewing attendees for an IT conference. Core flow is a registration form (`index.php`) -> `success.php` (inserts) -> `viewrecords.php` (lists).
- **Runtime:** Plain PHP (procedural) served either via Docker Compose (provided) or a local XAMPP Apache+PHP install. Database is MySQL accessed via PDO.

**How to run (local Docker)**

- From the project root (`.`) run: `docker compose up --build` — app available at `http://localhost:9000`, phpMyAdmin at `http://localhost:8080`.
- Before starting: ensure `db/password.txt` exists (the compose file uses it as a secret). The MySQL service exposes `3306:3306`.

**How to run (XAMPP / direct PHP)**

- Copy or place the project under your Apache `htdocs` (this workspace is already under XAMPP). Open `index.php` in a browser, e.g. `http://localhost/foothill-cs84a-attendance/index.php` (adjust path to your htdocs layout).

**Key files and responsibilities**

- `index.php`: registration form; pulls dynamic lists via `db/conn.php` + `crud.php`.
- `success.php`: handles the form POST and performs inserts (review for validation/sanitization before changing).
- `viewrecords.php`: shows attendees; good place to add filters/pagination.
- `db/conn.php`: creates a `PDO` connection and instantiates the `Crud` class (`db/crud.php`). The app expects a `$crud` object after including this file.
- `db/crud.php`: business logic for DB operations (use this to locate queries and change data behavior).
- `includes/header.php` and `includes/footer.php`: common layout; most pages `require_once` them.

**Patterns & conventions (project-specific)**

- Procedural style with `require_once` for sharing `PDO`/`$crud` and layout. Do not refactor to classes without checking all includes.
- Debug gating via a global `$DEBUG` variable at the top of scripts (e.g. `index.php`, `db/conn.php`). Enable it to show errors during development.
- PDO usage: `db/conn.php` sets `PDO::ERRMODE_EXCEPTION`. When modifying DB code, use prepared statements in `db/crud.php` to match existing style.

**Important gotchas discovered**

- DB name mismatch: `compose.yaml` sets `MYSQL_DATABASE=attendance` but `db/conn.php` uses `$db = 'attendance_db'`. Align these before running the Docker stack (update `compose.yaml` or `db/conn.php`).
- Secrets: `compose.yaml` expects `db/password.txt` (secret). If running under XAMPP, `db/conn.php` currently uses an empty `$pass = ''`—adjust to match your MySQL setup.

**Useful commands & quick examples**

- Start with Docker (rebuild): `cd /path/to/foothill-cs84a-attendance && docker compose up --build`
- Open phpMyAdmin: `http://localhost:8080` (host set to service `db` in compose).
- Toggle verbose errors: set `$DEBUG = true;` at the top of `index.php` and `db/conn.php`.

**When editing behavior or schema**

- Update the SQL inside `db/crud.php` and confirm by inspecting `viewrecords.php` / `success.php` flows. There are no automated tests; manual verification in the browser or via `phpMyAdmin` is expected.

If anything here is unclear or you want more examples (e.g., where to add input sanitization, or a recommended set of SQL migrations), tell me which area to expand.
