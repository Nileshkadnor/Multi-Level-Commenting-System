# Laravel Multi-Level Commenting System

## Features
- Multi-level comments (up to 3 levels)
- Reply and nested replies
- Scheduled command to delete empty comments
- Bootstrap UI

## Installation

```bash
git clone <repo>
cd comments-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
