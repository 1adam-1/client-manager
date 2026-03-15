# Client Manager

A Laravel-based web application for managing **clients**, **orders (commandes)**, and **products**, with an admin-style dashboard and authentication.

> Note: The Laravel project lives inside the `demo1/` folder.

## What this app does

Main features (from the current routes/controllers):

- **Dashboard**
  - View the main dashboard
  - Filter dashboard data
  - Sort clients

- **Authentication & Users**
  - Register / Login / Logout
  - Edit user profile
  - Password reset (“forgot password” + reset token flow)
  - List users, search users, delete users

- **Clients**
  - Create a client
  - View/list clients
  - Search clients
  - Update client
  - Delete client
  - Invoice-related info (`infosFacture`)

- **Orders (Commandes)**
  - View order details (by token)
  - Show a specific order
  - Confirm an order
  - Show “Airlod Avis” view related to an order

- **Products / Cart**
  - List products
  - Add a product
  - Create a product
  - View a product
  - Search products
  - Add to cart / view cart / remove from cart
  - Checkout

## Tech stack

- **Backend:** PHP 8 + Laravel (project in `demo1/`)
- **Frontend tooling:** Laravel Mix (Node/NPM) (`demo1/package.json`)
- **Database:** MySQL (see `.env.example`)

## Getting started (local development)

### Requirements

- PHP **8.x**
- Composer
- Node.js + npm
- MySQL

### Setup

```bash
# 1) Go into the Laravel project
cd demo1

# 2) Install PHP dependencies
composer install

# 3) Create env file
cp .env.example .env

# 4) Generate app key
php artisan key:generate

# 5) Configure database in .env, then run migrations (if migrations exist)
php artisan migrate

# 6) Install frontend dependencies + build assets
npm install
npm run dev

# 7) Run the server
php artisan serve
```

Then open: `http://127.0.0.1:8000`

## Configuration

Edit `demo1/.env` for:

- `APP_URL`
- `DB_*` (MySQL credentials)
- Mail settings (if you use password reset emails)

## Project structure

- `demo1/` — Laravel application root
- `demo1/routes/web.php` — main web routes
- `demo1/app/Http/Controllers/` — controllers (clients, users, orders, products, dashboard)

