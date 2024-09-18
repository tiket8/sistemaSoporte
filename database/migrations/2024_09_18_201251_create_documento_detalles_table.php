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
        Schema::create('documento_detalles', function (Blueprint $table) {
            $table->id('docd_id');
            $table->unsignedBigInteger('doc_id');
            $table->text('docd_descrip');
            $table->timestamps();
        
            // Llave foránea
            $table->foreign('doc_id')->references('doc_id')->on('documentos')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_detalles');
    }
};
