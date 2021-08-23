## Environment
PHP 7.4

`composer install`

`cp .env.example .env`

`php artisan migrate:fresh --seed`

## Test
`./vendor/bin/phpunit`

`php artisan notify:users`

`php artisan rabbitmq:consume --queue=post_created`

`php artisan log --source=kernel`

`php artisan rabbitmq:consume --queue=critical_all_logs`

## Test Behat + Mink
`git checkout 932e122989ff18`

`composer update`

`./vendor/bin/behat --stop-on-failure --no-snippets`


