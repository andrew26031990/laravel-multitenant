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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->comment('ID сущности');
            $table->string('name')->comment('Наименование товара');
            $table->string('vendor_code')->nullable()->comment('Артикул');
            $table->boolean('is_active')->default(true)->comment('Статус');
            $table->foreignId('brand_id')->comment('Название бренда');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
