# PT Janur Tangguh Abadi — Forwarding Company Profile & Booking System

> Laravel-based web application for company profile and forwarding service booking management.

---

## Table of Contents

- [Overview](#overview)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Getting Started](#getting-started)
- [Environment Configuration](#environment-configuration)
- [Database](#database)
- [Project Structure](#project-structure)
- [Authentication & Authorization](#authentication--authorization)
- [Features](#features)
- [Routes Reference](#routes-reference)
- [Seeders & Default Accounts](#seeders--default-accounts)
- [Artisan Commands Reference](#artisan-commands-reference)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)

---

## Overview

This application serves as the official digital presence for **PT Janur Tangguh Abadi**, a forwarding/logistics company. It provides:

- Public company profile pages (About, Services, Contact)
- Customer-facing booking system for forwarding services
- Admin dashboard for booking management, reporting, and content management

---

## Tech Stack

| Layer        | Technology                          |
|--------------|-------------------------------------|
| Framework    | Laravel 11                          |
| Language     | PHP 8.2+                            |
| Database     | MySQL 8.x                           |
| Frontend     | Blade Templating + Tailwind CSS     |
| Icons        | Font Awesome                        |
| Auth         | Custom (session-based, role-based)  |
| ORM          | Eloquent                            |

---

## Requirements

- PHP >= 8.2
- Composer >= 2.x
- MySQL >= 8.0
- Node.js >= 18.x *(if using Vite for asset compilation)*
- Git

---

## Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/your-org/janur-tangguh-abadi.git
cd janur-tangguh-abadi
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies *(optional, if using Vite)*

```bash
npm install && npm run build
```

### 4. Copy environment file

```bash
cp .env.example .env
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Configure your `.env` (see [Environment Configuration](#environment-configuration))

### 7. Run database migrations and seed

```bash
php artisan migrate --seed
```

### 8. Start the development server

```bash
php artisan serve
```

Application will be available at: **http://localhost:8000**

---

## Environment Configuration

Key variables to configure in your `.env` file:

```dotenv
APP_NAME="PT Janur Tangguh Abadi"
APP_ENV=local
APP_KEY=             # auto-generated via php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project-kp
DB_USERNAME=root
DB_PASSWORD=
```

> **Note:** Never commit your `.env` file. It is already listed in `.gitignore`.

---

## Database

### Schema Overview

```
users
  └──< bookings >──┐
                   └── layanan
bookings
  └──< status_bookings

company_profiles   (standalone, managed by admin)
```

### Tables

#### `users`

| Column       | Type                        | Notes                |
|--------------|-----------------------------|----------------------|
| user_id      | INT (PK, AI)                |                      |
| nama         | VARCHAR(100)                |                      |
| email        | VARCHAR(100) UNIQUE         |                      |
| password     | VARCHAR                     | bcrypt hashed        |
| no_hp        | VARCHAR(20)                 | nullable             |
| alamat       | TEXT                        | nullable             |
| role         | ENUM(`admin`, `customer`)   | default: `customer`  |
| created_at   | DATETIME                    |                      |
| updated_at   | DATETIME                    |                      |

#### `layanan`

| Column           | Type         | Notes    |
|------------------|--------------|----------|
| layanan_id       | INT (PK, AI) |          |
| nama_layanan     | VARCHAR(100) |          |
| deskripsi        | TEXT         | nullable |
| harga            | DECIMAL(12,2)| nullable |
| estimasi_waktu   | VARCHAR(50)  | nullable |

#### `bookings`

| Column              | Type                                                       | Notes                              |
|---------------------|------------------------------------------------------------|------------------------------------|
| booking_id          | INT (PK, AI)                                               |                                    |
| kode_booking        | VARCHAR(20) UNIQUE                                         | Auto: `JTA-YYYYMMDD-XXXX`          |
| user_id             | INT (FK → users)                                           |                                    |
| layanan_id          | INT (FK → layanan)                                         |                                    |
| tanggal_booking     | DATE                                                       |                                    |
| tanggal_pengiriman  | DATE                                                       | nullable                           |
| asal                | VARCHAR(150)                                               |                                    |
| tujuan              | VARCHAR(150)                                               |                                    |
| detail_barang       | TEXT                                                       | nullable                           |
| berat_barang        | DECIMAL(8,2)                                               | nullable, in kg                    |
| status              | ENUM(`Menunggu`,`Diproses`,`Dijadwalkan`,`Selesai`,`Dibatalkan`) | default: `Menunggu`   |

#### `status_bookings`

| Column      | Type             | Notes                     |
|-------------|------------------|---------------------------|
| status_id   | INT (PK, AI)     |                           |
| booking_id  | INT (FK → bookings) |                        |
| updated_by  | INT (FK → users) | Admin user_id             |
| status      | VARCHAR(50)      |                           |
| keterangan  | TEXT             | nullable, admin notes     |
| updated_at  | DATETIME         |                           |

#### `company_profiles`

| Column           | Type         | Notes    |
|------------------|--------------|----------|
| profile_id       | INT (PK, AI) |          |
| nama_perusahaan  | VARCHAR(150) |          |
| visi             | TEXT         | nullable |
| misi             | TEXT         | nullable |
| sejarah          | TEXT         | nullable |
| alamat           | TEXT         | nullable |
| email            | VARCHAR(100) | nullable |
| telepon          | VARCHAR(20)  | nullable |

### Migration Commands

```bash
# Run all migrations
php artisan migrate

# Rollback last batch
php artisan migrate:rollback

# Fresh migrate + seed (destructive — dev only)
php artisan migrate:fresh --seed

# Check migration status
php artisan migrate:status
```

---

## Project Structure

```
janur-tangguh-abadi/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── AboutController.php
│   │   │   ├── LayananController.php
│   │   │   ├── KontakController.php
│   │   │   ├── AuthController.php
│   │   │   ├── BookingController.php
│   │   │   └── Admin/
│   │   │       ├── AdminController.php
│   │   │       ├── AdminBookingController.php
│   │   │       ├── AdminLayananController.php
│   │   │       ├── AdminLaporanController.php
│   │   │       ├── AdminCompanyController.php
│   │   │       └── AdminSearchController.php
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php
│   │   └── Requests/
│   │       └── BookingRequest.php
│   │
│   └── Models/
│       ├── User.php
│       ├── Layanan.php
│       ├── Booking.php
│       ├── StatusBooking.php
│       └── CompanyProfile.php
│
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_users_table.php
│   │   ├── xxxx_create_layanan_table.php
│   │   ├── xxxx_create_bookings_table.php
│   │   ├── xxxx_create_status_bookings_table.php
│   │   └── xxxx_create_company_profiles_table.php
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── LayananSeeder.php
│   │   └── CompanyProfileSeeder.php
│   └── factories/
│       └── UserFactory.php
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php          # Public layout
│       │   └── admin.blade.php        # Admin layout
│       ├── home/
│       │   └── index.blade.php
│       ├── about/
│       │   └── index.blade.php
│       ├── layanan/
│       │   └── index.blade.php
│       ├── kontak/
│       │   └── index.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── booking/
│       │   ├── create.blade.php
│       │   ├── status.blade.php
│       │   └── riwayat.blade.php
│       └── admin/
│           ├── dashboard.blade.php
│           ├── bookings/
│           │   ├── index.blade.php
│           │   └── show.blade.php
│           ├── layanan/
│           │   └── index.blade.php
│           ├── laporan/
│           │   └── index.blade.php
│           ├── company/
│           │   └── edit.blade.php
│           └── searching/
│               └── index.blade.php
│
└── routes/
    └── web.php
```

---

## Authentication & Authorization

### Roles

| Role       | Description                                          |
|------------|------------------------------------------------------|
| `admin`    | Full access: manage bookings, layanan, company profile, reports |
| `customer` | Can create bookings, view own booking history        |
| *(guest)*  | Can view public pages and check booking status by code |

### Middleware

**`RoleMiddleware`** — enforces role-based access on protected routes.

```php
// Usage in routes/web.php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // admin-only routes
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    // customer-only routes
});
```

### Flow

```
Guest  →  /login or /register
             │
             ▼
         Auth check
             │
      ┌──────┴──────┐
      ▼             ▼
   role=admin    role=customer
      │             │
      ▼             ▼
  /admin/*       /booking/*
  dashboard      riwayat
```

---

## Features

### Public Pages

| Page      | URL        | Description                                     |
|-----------|------------|-------------------------------------------------|
| Home      | `/`        | Hero banner, service highlights, CTA            |
| About     | `/tentang` | Company history, vision & mission               |
| Services  | `/layanan` | Full service list with pricing and estimates    |
| Contact   | `/kontak`  | Address, phone, email, Maps embed               |

### Customer Features

| Feature             | URL                  | Auth Required |
|---------------------|----------------------|---------------|
| Create Booking      | `/booking`           | ✅ Customer   |
| Check Booking Status| `/booking/status`    | ❌ Public     |
| Booking History     | `/booking/riwayat`   | ✅ Customer   |

### Admin Features

| Feature               | URL                        | Description                                     |
|-----------------------|----------------------------|-------------------------------------------------|
| Dashboard             | `/admin/dashboard`         | Stats: total, pending, in-progress, done        |
| Booking List          | `/admin/bookings`          | Filter by status, search by name/code           |
| Booking Detail        | `/admin/bookings/{id}`     | Update status + view history log                |
| Manage Services       | `/admin/layanan`           | CRUD — add, edit, delete layanan                |
| Reports               | `/admin/laporan`           | Filter by date range, booking statistics        |
| Company Profile       | `/admin/company`           | Edit visi, misi, contact info                   |
| Global Search         | `/admin/searching`         | Search across bookings, customers, services     |

### Booking Status Flow

```
Menunggu  →  Diproses  →  Dijadwalkan  →  Selesai
                                    └──→  Dibatalkan
```

Every status change is logged to `status_bookings` table with admin ID, timestamp, and optional notes.

### Booking Code Format

Auto-generated on booking creation:

```
JTA-YYYYMMDD-XXXX
     │         └── 4 random alphanumeric chars
     └── date of booking
```

Example: `JTA-20241215-A3F2`

---

## Routes Reference

### Public Routes

```
GET  /                  → HomeController@index
GET  /tentang           → AboutController@index
GET  /layanan           → LayananController@index
GET  /kontak            → KontakController@index
```

### Auth Routes

```
GET   /login            → AuthController@showLogin
POST  /login            → AuthController@login
GET   /register         → AuthController@showRegister
POST  /register         → AuthController@register
POST  /logout           → AuthController@logout
```

### Customer Routes *(middleware: auth)*

```
GET   /booking          → BookingController@create
POST  /booking          → BookingController@store
GET   /booking/status   → BookingController@cekStatus
GET   /booking/riwayat  → BookingController@riwayat
```

### Admin Routes *(middleware: auth, role:admin)*

```
GET     /admin/dashboard                → AdminController@dashboard

GET     /admin/bookings                 → AdminBookingController@index
GET     /admin/bookings/{id}            → AdminBookingController@show
PATCH   /admin/bookings/{id}/status     → AdminBookingController@updateStatus

GET     /admin/layanan                  → AdminLayananController@index
POST    /admin/layanan                  → AdminLayananController@store
PUT     /admin/layanan/{id}             → AdminLayananController@update
DELETE  /admin/layanan/{id}             → AdminLayananController@destroy

GET     /admin/laporan                  → AdminLaporanController@index

GET     /admin/company                  → AdminCompanyController@edit
PUT     /admin/company                  → AdminCompanyController@update

GET     /admin/searching                → AdminSearchController@index
```

---

## Seeders & Default Accounts

Run seeders with:

```bash
php artisan db:seed
```

Or individually:

```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=LayananSeeder
php artisan db:seed --class=CompanyProfileSeeder
```

### Default Accounts

| Role     | Email               | Password   |
|----------|---------------------|------------|
| Admin    | admin@janur.com     | admin123   |

> ⚠️ **Change the default admin password immediately in production.**

### Seeded Services (Layanan)

1. Pengiriman Domestik
2. Pengiriman Internasional
3. Custom Clearance
4. Door to Door
5. Freight Forwarding

---

## Artisan Commands Reference

```bash
# Development
php artisan serve                        # Start dev server
php artisan migrate                      # Run migrations
php artisan migrate:fresh --seed         # Reset DB + seed (dev only)
php artisan migrate:rollback             # Rollback last batch
php artisan db:seed                      # Run all seeders
php artisan key:generate                 # Generate APP_KEY

# Cache management
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Create admin via Tinker
php artisan tinker
>>> User::create([
...   'nama'     => 'Admin Baru',
...   'email'    => 'adminbaru@janur.com',
...   'password' => Hash::make('password123'),
...   'role'     => 'admin',
... ]);

# Inspect routes
php artisan route:list
php artisan route:list --path=admin
```

---

## Troubleshooting

### `php artisan migrate` fails — access denied

Check `DB_USERNAME` and `DB_PASSWORD` in `.env`. Make sure the database exists:

```sql
CREATE DATABASE project-kp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### `No application encryption key has been specified`

```bash
php artisan key:generate
```

### 403 Unauthorized on admin pages

Ensure your user's `role` column is set to `admin` in the database:

```bash
php artisan tinker
>>> User::where('email', 'admin@janur.com')->update(['role' => 'admin']);
```

### Views not reflecting changes (cached)

```bash
php artisan view:clear
php artisan cache:clear
```

### Login redirects back without logging in

Check that `session` driver is configured correctly in `.env`:

```dotenv
SESSION_DRIVER=file
```

Also ensure `storage/` directory is writable:

```bash
chmod -R 775 storage bootstrap/cache
```

---

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/nama-fitur`
3. Commit your changes: `git commit -m "feat: tambah fitur X"`
4. Push to your branch: `git push origin feature/nama-fitur`
5. Open a Pull Request

### Commit Convention

Follow [Conventional Commits](https://www.conventionalcommits.org/):

```
feat:     fitur baru
fix:      perbaikan bug
refactor: refactor kode tanpa mengubah behavior
docs:     perubahan dokumentasi
style:    perubahan formatting (no logic change)
chore:    update dependency, konfigurasi, dll
```

---

> Built for PT Janur Tangguh Abadi · Laravel 11 · PHP 8.2+
