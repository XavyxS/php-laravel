#!/bin/bash

until nc -z -v -w30 postgres.railway.internal 5432; do
  echo "Waiting for database connection..."
  sleep 5
done

echo "Database is up - executing migrations"
php artisan migrate
