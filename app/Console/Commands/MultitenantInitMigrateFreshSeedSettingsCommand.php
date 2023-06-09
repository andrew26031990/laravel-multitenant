<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Models\Tenant\Product;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class MultitenantInitMigrateFreshSeedSettingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multitenant:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(app()->environment() != 'production'){
            if ($this->confirm('Are you sure you want to refresh project in '.app()->environment().' mode (not recomended in production)?')) {
                $this->info('Drop tenants databases...');
                foreach (Tenant::all() as $tenant) {
                    $db = "tenant_{$tenant->id}_db";
                    DB::connection('pgsql')->statement('DROP DATABASE IF EXISTS "' . $db . '" WITH (FORCE)');
                }
                $this->info('Done');

                $this->info('Migrate and fresh (central)...');
                \Artisan::call('migrate:fresh');
                $this->info('Done');

                $this->info('Refreshing testing database...(central)');
                \Artisan::call('migrate:fresh --env=testing');
                $this->info('Done');

                $this->info('Seeding database (central and tenant)');
                \Artisan::call('db:seed');
                $this->info('Done');

                $this->info('Applying Laravel Passport keys...');
                \Artisan::call('passport:keys');
                $this->info('Done');

                $this->info('Applying Laravel Passport personal keys...');
                \Artisan::call('passport:client --personal --name=revo');
                $this->info('Done');
            }
        }else{
            $this->info('You are in production mode. Access denied!!');
        }
        return Command::SUCCESS;
    }
}
