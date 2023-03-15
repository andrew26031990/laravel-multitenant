<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CentralUser;
use App\Models\Tenant;
use App\Models\Tenant\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            //UserSeeder::class
        ]);

        //Создание пользователей с тенантами (компаниями) и их связка через pivot таблицу
        CentralUser::factory()->count(1)
            ->has(
                Tenant::factory()->count(1),
            )
            ->create();

        //Создание доменов к тенантам (компаниям)
        \App\Models\Tenant::all()->runForEach(function ($tenant) {
            $tenant->domains()->create(['domain' => $tenant->slug.'.localhost']);
            Product::factory(10)->create();
        });

    }
}
