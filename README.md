#INIT
php artisan sail:install

alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

#COMMANDS

sail up

sail artisan make:migration create_tests_table --create=tests --path=database/migrations/tenant

sail artisan tenants:migrate 

sail artisan code:models

sail artisan code:models --connection=pgsql_tenant


#MY_COMMANDS

sail up

sail artisan migrate

sail artisan tenants:migrate

sail artisan passport:client --personal




