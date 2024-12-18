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
    Schema::table('tickets', function (Blueprint $table) {
        $table->unsignedBigInteger('cats_id')->nullable()->after('cat_id');

        // Si necesitas una relación con la tabla subcategorias
        $table->foreign('cats_id')->references('subcat_id')->on('subcategorias');
    });
}

public function down()
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->dropForeign(['cats_id']);
        $table->dropColumn('cats_id');
    });
}

};
