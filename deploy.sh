#!/bin/bash

# get last commits
git pull

# install composer components
composer install

# run migrations
php artisan migrate

php artisan key:generate
php artisan config:cache

# serve
php artisan serve
