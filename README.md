#INIT
php artisan sail:instal

#COMMANDS

./vendor/bin/sail up

./vendor/bin/sail artisan make:migration create__table --create= --path=database/migrations/tenant

./vendor/bin/sail artisan tenants:migrate 

./vendor/bin/sail artisan code:models

./vendor/bin/sail artisan model:generate

./vendor/bin/sail artisan code:models --connection=pgsql_tenant


