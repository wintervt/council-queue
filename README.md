## About

- Tailwind, Vue and Laravel Queue application.

## Versions
- NPM: 6.14.13
- Node: 14.17.0
- PHP: 8.0

## Installation:

## 1. Create database

Create an empty MYSQL database in your preferred environment and save credentials for later use.

## 2. Set Environment Variables

Copy the `.env.example` file and rename it to `.env` then fill in each of the required variables.

## 3. Install Composer packages and generate database tables

```

composer install

php artisan key:generate

php artisan migrate

php artisan db:seed

```

Note: The Database Seeder file will populate the given Services and Customer Types.

## 4. Install npm packages

```

npm install

```

## 5. Serve website

```

php artisan serve

```

You can now visit the home page url in your browser
