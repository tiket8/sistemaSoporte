<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCategoriasAndSubcategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->boolean('estatus')->default(true); // Activo por defecto
        });

        Schema::table('subcategorias', function (Blueprint $table) {
            $table->boolean('estatus')->default(true); // Activo por defecto
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropColumn('estatus');
        });

        Schema::table('subcategorias', function (Blueprint $table) {
            $table->dropColumn('estatus');
        });
    }
}
