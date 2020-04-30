#! /bin/bash

set -e

cat > .env <<- EOF
APP_ENV=testing
APP_KEY=
APP_DEBUG=true

LOG_CHANNEL=single

DB_CONNECTION=pgsql
DB_HOST=database
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=postgres
EOF

php artisan key:generate
php artisan horizon:publish

until psql -h database -U postgres -c '\l'; do
  sleep 1
done

php artisan migrate:refresh

find ./tests -type f -name '*.php' | xargs sed -i 's/@covers//'

if [[ $1 != 'develop' ]]; then
  rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
fi

./vendor/bin/phpunit --dump-xdebug-filter xdebug-filter.php
./vendor/bin/phpunit --prepend xdebug-filter.php --config=phpunit.xml
