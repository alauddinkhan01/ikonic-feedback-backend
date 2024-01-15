# Ikonic feedback

This is Ikonic feedback system

## Installation

Clone the Project:

```bash
git clone https://github.com/alauddinkhan01/ikonic-feedback-backend.git
```

Install composer:

```bash
composer install
```
Create .env file:

```bash
cp .env.example .env
```
Create .env APP_KEY:

```bash
php artisan key:generate
```
Migrate database (Note: connect your project with database first then run the following command)

```bash
php artisan migrate
```
Run the project

```bash
php artisan serve
```

