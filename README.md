# URL Shortener (Laravel Learning Project)
A URL shortening service built with the Laravel framework.

## Motivation
This project was created as a hands-on exercise to gain practical experience with Laravel.

## Live Demo
A live version of this application is hosted at:

[**url-shortener.christianpropp.de**](https://url-shortener.christianpropp.de)

**Note:** The live demo is for demonstration purposes only.

## Getting Started
If you like to use Docker replace the podman with docker in the following commands.

**1. Run the container**
```bash
podman compose up -d && podman exec -it url-shortener /bin/bash
```

**2. Create Laravel's .env file**
```bash
cp .env.example .env
```

**3. Install dependencies**
```bash
composer install && npm i
```

**4. Generate Laravel's app key**
```bash
php artisan key:generate
```

**5. Migrate the database**
```bash
php artisan migrate
```

When prompted, confirm that you want to create the database.

**6. Run the development server**
```bash
composer run dev
```

You should now be able to access the application in your browser at the configured address.
