<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    public function up()
    {
        // Check if the table exists before creating it
        if (!Schema::hasTable('favorites')) {
            Schema::create('favorites', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('product_id');
                $table->timestamps();

                // Uncomment the foreign key
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::table('favorites', function (Blueprint $table) {
            // Specify the foreign key constraint name
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('favorites');
    }
}
