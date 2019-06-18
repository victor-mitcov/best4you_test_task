#!/bin/bash

composer install;

php artisan key:generate;

php artisan migrate --seed

npm install;

php-fpm;