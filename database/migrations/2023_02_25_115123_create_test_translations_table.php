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
        Schema::create('test_translations', function (Blueprint $table) {
            $table->foreignId('test_id')->unsigned()->constrained('tests')->onDelete('cascade');
            $table->string('locale', 4)->index()->comment('Язык');
            $table->string('title', 4)->nullable()->comment('Название');
            $table->unique(['test_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_translations');
    }
};
