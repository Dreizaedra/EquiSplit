#!/bin/sh

# Waiting for the database to be ready
until nc -z -v -w5 $DB_HOST 3306
do
  echo "Waiting for the database to be ready on $DB_HOST:3306..."
  sleep 2
done

# Executing the migrations, generating JWT keys and starting the application
php bin/console doctrine:database:create --if-not-exists &&
php bin/console doctrine:migrations:migrate --no-interaction &&
php bin/console doctrine:fixtures:load --no-interaction &&
php bin/console lexik:jwt:generate-keypair &&
php-fpm & nginx -g 'daemon off;'
