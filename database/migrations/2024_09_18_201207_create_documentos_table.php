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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id('doc_id');
            $table->unsignedBigInteger('tick_id');
            $table->string('doc_nom');
            $table->string('doc_path');
            $table->timestamps();
        
            // Llave foránea
            $table->foreign('tick_id')->references('tick_id')->on('tickets')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
