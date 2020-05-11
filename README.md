# FANNY backend

![Release](https://img.shields.io/badge/Release-0.1.0-blue.svg)

## Context

This project is part of the implementation of the FANNY protocol, divided into 2 main distinct projects
([the API backend](https://github.com/FANNY-20/FANNY-backend) and
[the hybrid mobile application](https://github.com/FANNY-20/FANNY-hybrid-app)).
A third project ([the geolocation simulator](https://github.com/FANNY-20/FANNY-geolocation-simulator))
is also available as a development tool or for manual testing.
You can learn more about the FANNY protocol itself [here](https://github.com/FANNY-20/The_FANNY_protocol_V0.1).

## Warning, please read carefully

Some packages in the `composer.json` reference privately hosted packages (those starting with `soyhuce/*`).
Those packages will be released publicly soon. Thus, the installation will fail until these ones are made available.

## Prerequisites

- PHP 7.4
- PostgreSQL 12
- PostGIS 3.0.1 (as an extension of PostgreSQL)
- Redis server 6.0.1 (but it is not mandatory, you just have to change the env file if you don't want to use Redis)
- PHP extensions:
    - json
    - dom
    - curl
    - bcmath
    - mbstring
    - pcntl
    - pgsql
    - pdo_pgsql
    - zip
    - gd
    - opcache
    - redis

## Commands

### Copy env file

```bash
$ cp .env.example .env
```

### Generate app key

```bash
$ php artisan key:generate
```

### Install dependencies

```bash
$ composer install
```

### Link public storage folder

```bash
$ php artisan storage:link
```

### Publish Horizon assets

```bash
$ php artisan horizon:publish
```

### Run Horizon

```bash
$ php artisan horizon
```

### Run database migrations

```bash
$ php artisan migrate:fresh
```

### Run database migrations with data seeds

```bash
$ php artisan migrate:fresh --seed
```

### Run tests

```bash
$ php artisan test
```

## Changelog

[See CHANGELOG](./CHANGELOG.md)

## License

[MIT](./LICENSE)
