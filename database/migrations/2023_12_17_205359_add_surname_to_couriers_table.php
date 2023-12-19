<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('couriers', function (Blueprint $table) {
        $table->string('surname')->nullable();
    });
}

public function down()
{
    Schema::table('couriers', function (Blueprint $table) {
        $table->dropColumn('surname');
    });
}
};
