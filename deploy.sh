#!/bin/bash

# get last commits
git pull

# install composer components
composer install

# run migrations
php artisan migrate

# serve
php artisan serve
