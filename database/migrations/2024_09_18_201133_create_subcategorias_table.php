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
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id('subcat_id');
            $table->unsignedBigInteger('cat_id');
            $table->string('subcat_nom');
            $table->timestamps();
        
            // Llave foránea
            $table->foreign('cat_id')->references('cat_id')->on('categorias');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategorias');
    }
};
