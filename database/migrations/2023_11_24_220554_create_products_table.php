<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        // Проверяем, существует ли таблица, прежде чем её создать
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->decimal('price', 8, 2);
                $table->string('brand');
                $table->integer('stock_quantity');
                $table->string('image_path')->nullable();
                $table->unsignedBigInteger('category_id');
                $table->timestamps();


            });
        }
    }
    public function down()
{

    Schema::dropIfExists('products');
    }
}
