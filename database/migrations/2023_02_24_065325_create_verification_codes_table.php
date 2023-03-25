<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verification_codes', function (Blueprint $table) {
            $table->id()->comment('ID сущности');
            $table->string('otp')->comment('OTP код');
            $table->timestamp('expired_at')->comment('Срок жизни OTP кода');
            //$table->bigInteger('user_id')->unsigned();
            $table->string('central_user_id')->comment('Пользователь OTP');
            //$table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('central_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verification_codes');
    }
};
