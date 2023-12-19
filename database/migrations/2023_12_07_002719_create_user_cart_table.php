<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCartTable extends Migration
{
    public function up()
    {
        Schema::create('user_cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Внешний ключ на таблицу пользователей
            $table->foreignId('product_id')->constrained(); // Внешний ключ на таблицу продуктов
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_cart');
    }
}
