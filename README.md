# Laravel Query Optimization thru Various Methods

## Mission
- avoid memory hogging /timeout
- Ensure Correct Data is Retured
- Use the Most Optimized Query to Get the Required Data
- Use SOLID Principles and Other Design Patterns


## Requirements
- PHP 7.4
- PostgreSQL 12
- Redis 4-6
- Laravel 8
- Composer
- valet (optional)


## Usage
- git clone https://goldcoders/watchcrunch.test
- cp .env.example .env
- composer install
- valet start / php artisan serve
- php artisan migrate:fresh --seed
- php artisan queue:work

## Note:
- make sure your intance of PostgreSQL and Redis is Active


## URLS to Visit
- `/top-users/{postCount?}` - Query Optimized Endpoint
- `/chunk-top-users/{postCount?}/{chunkCount?}` - Further Optmized Thru Chunks and Cached
- `/queue-top-users/{postCount?}/{chunkCount?}` - Added Queue Jobs on Top of All Optimization

## Run Test
- php artisan test

1. the test ensures required keys in the array is returned
1. simple test to check if database seeder is seed
1. check if the first top post returns correctly the last post title, since laravel can sometimes cant detect it when seeded at the same timestamp.
1 check if top users that posted is the same number as the one seeded
