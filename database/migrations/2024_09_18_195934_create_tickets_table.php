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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('tick_id');
            $table->unsignedBigInteger('usu_id');
            $table->unsignedBigInteger('cat_id');
            $table->string('tick_titulo');
            $table->text('tick_descrip');
            $table->enum('tick_estado', ['abierto', 'cerrado'])->default('abierto');
            $table->timestamps();
        
            // Llaves foráneas
            $table->foreign('usu_id')->references('usu_id')->on('usuarios');
            $table->foreign('cat_id')->references('cat_id')->on('categorias');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
