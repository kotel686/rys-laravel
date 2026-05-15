# Rys – Výškové práce (Laravel + Filament v5)

Public landing page for **František Rys – Výškové práce** plus a Filament v5
admin panel that manages the dynamic content (reference projects, gallery
photos and videos).

The visual design is a one-to-one port of the original React/Vite/Tailwind
prototype shipped in `rys-vyskove-stavby-web-main.zip`.

## Stack

- **PHP 8.3** / **Laravel 13**
- **Filament v5** (admin panel, file uploads, image editor)
- **Tailwind v4** via `@tailwindcss/vite`
- **AlpineJS** (mobile nav, small interactions)
- **lightGallery** (front-end lightbox for projects and media gallery)
- **SQLite** by default (zero-setup)

## Project layout

```
app/
  Filament/Resources/           ProjectResource, PhotoResource, VideoResource
  Http/Controllers/             HomeController, ContactController
  Http/Requests/ContactRequest  Validation + honeypot
  Models/                       Project, Photo, Video, User (FilamentUser)
  Providers/Filament/           AdminPanelProvider (Filament v5)
resources/views/
  layouts/app.blade.php         Master layout (Vite, CSRF)
  home.blade.php                Composition of all sections
  partials/                     navigation, footer
  sections/                     hero, services, projects, gallery, contact
database/
  migrations/                   projects, photos, videos
  seeders/                      AdminUserSeeder reads ADMIN_* env vars
```

## Setup

```bash
cp .env.example .env

# fill in at least these — never commit them
#   ADMIN_NAME="Administrátor"
#   ADMIN_EMAIL=admin@example.com
#   ADMIN_PASSWORD='at-least-12-chars-strong-passphrase'
#   ADMIN_EMAILS=admin@example.com         # comma-separated allow-list
#   CONTACT_RECIPIENT=franta.rys@gmail.com

composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link

npm install
npm run build       # or `npm run dev` for HMR
php artisan serve
```

- Public site:   <http://localhost:8000/>
- Admin login:   <http://localhost:8000/admin>

## Admin

- `/admin` is served by Filament v5 (panel ID `admin`).
- Only users whose email appears in `ADMIN_EMAILS` **and** whose
  `email_verified_at` is set may log in (`App\Models\User::canAccessPanel`).
- Initial admin is created idempotently from `ADMIN_*` env vars by
  `Database\Seeders\AdminUserSeeder`. After first login, rotate the password
  from the panel and remove `ADMIN_PASSWORD` from the deployment env.
- Uploads land on the `public` disk (`storage/app/public`) and are exposed
  via the `storage:link` symlink.

## Front-end gallery (lightGallery)

`resources/js/app.js` auto-initialises lightGallery on every element whose
id ends with `-gallery`:

- `#projects-gallery` – Moje reference (images + captions),
- `#media-gallery`    – Galerie z mé práce (photos + videos).

Anchor children carry `href` (full asset), `data-sub-html` (caption HTML)
and, for videos, `data-video` + `data-poster`. The Blade templates render
exactly that structure so the thumbnail look stays identical to the
original site, only the click behaviour changes (lightbox instead of a
modal).

## Security choices

- `AppServiceProvider` forces HTTPS in production and installs a default
  password policy (≥12 chars, mixed case, digits, symbols, `uncompromised`
  check on production – pwned-passwords API via Laravel).
- Admin panel access is **fail-closed**: empty `ADMIN_EMAILS` denies
  everyone. `email_verified_at` is required as a second gate.
- Sessions are encrypted (`SESSION_ENCRYPT=true`), `same_site=lax`,
  `secure_cookie` should be `true` behind TLS.
- Contact form: CSRF token + Laravel validation, honeypot field
  (`website`), explicit GDPR consent checkbox, route-level
  `throttle:10,60` middleware **and** an IP-based limit of 5 submissions
  per hour enforced inside `ContactController` (defence in depth).
- Bcrypt rounds default to 12; passwords are hashed on cast (`'password'
  => 'hashed'`).
- File uploads in Filament restrict MIME types and max size for images
  (8 MB) and videos (200 MB).
- No hard-coded credentials anywhere – everything sensitive is in `.env`
  and the seeder refuses weak passwords (`< 12` chars).

## Original React prototype

The original React/Vite source (for visual reference) lives in
`/workspace/uploads/rys-web-source/rys-vyskove-stavby-web-main`. It is not
needed at runtime.
