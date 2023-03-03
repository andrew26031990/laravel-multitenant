<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\TestLog;
use App\Models\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*User::factory()->count(3)
            ->has(
                Test::factory()
                    ->has(
                        TestLog::factory()->count(2)
                    )->count(2)
            )
            ->create();*/
    }
}
