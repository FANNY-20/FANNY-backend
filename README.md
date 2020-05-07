# FANNY backend

![Release](https://img.shields.io/badge/Release-0.1.0-blue.svg)

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
