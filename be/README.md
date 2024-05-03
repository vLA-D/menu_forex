# Menu FOREX back-end

Back-end is built as a stateless API for serving different kinds of front-ends (mobile applications, web applications, third party usage, etc.).
It uses MySQL 8 database and PHP 8.2 language, while also taking advantage of Redis for caching purposes and easy way to setup queues. It is built using Laravel 11 PHP framework, while
tests are written with help of PHPUnit framework.

Application's back-end is containerized with only dependency being docker.

### Requirements:

- docker
- docker compose

Docker configuration files are placed inside `be/docker` directory. It consists of simple PHP 8.2, MySQL 8 and a Redis image, with proper network and volumes setup. 

### Setup process

- Make sure you are positioned inside of `be` directory
- Copy example environment file by running `cp .env.example .env`
- Change working directory to docker directory: `cd docker`
- Copy example environment file by running `cp .env.example .env`
- Make sure there are no other running containers that could interfere with this application (to stop all running containers you may run `docker stop $(docker ps -q)`)
- Run: `docker compose up -d` in order to build containers
- Run: `docker compose exec app composer install` in order to install composer dependencies
- Run: `docker compose exec app php artisan key:generate` to generate application key
- Run: `docker compose exec app php artisan migrate --seed` to run migrations and seed application data

Recommended way to access application is by using front-end, but its base url is `http://localhost/api` and can be tested via tools like Postman, Insomnia, etc.

### Running tests (PHPUnit)
- Change working directory to docker directory: `cd docker`
- Run `docker compose exec app vendor/bin/phpunit` in order to run whole test suite
