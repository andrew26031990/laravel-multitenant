<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary()->comment('ID сущности');;

            // your custom columns may go here
            $table->string('name')->comment('Название компании');
            $table->string('slug')->unique()->comment('URL компании');
            //$table->string('plan');
            // your custom columns may go here

            $table->timestamps();
            $table->json('data')->nullable()->comment('Данные компании (по умолчанию имя базы данных)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
