<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*Schema::create('users', function (Blueprint $table) {
            $table->uuid('global_id')->primary();
            $table->string('first_name')->comment('Имя');
            $table->string('last_name')->comment('Фамилия');
            //$table->string('phone')->unique()->comment('Номер телефона');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('users');
    }
};
