# stop-covid-backend

![Release](https://img.shields.io/badge/Release-0.1.0-blue.svg)

## Commandes

### Copier le fichier d'environnement

```bash
$ cp .env.example .env
```

### Générer une clé applicative

```bash
$ php artisan key:generate
```

### Installer les dépendances

```bash
$ composer install
```

### Lier le dossier de stockage public

```bash
$ php artisan storage:link
```

### Publier les assets Horizon

```bash
$ php artisan horizon:publish
```

### Lancer les migrations de base de données

```bash
$ php artisan migrate:fresh
```

### Lancer les migrations de base de données avec un jeu de donnée

```bash
$ php artisan migrate:fresh --seed
```


