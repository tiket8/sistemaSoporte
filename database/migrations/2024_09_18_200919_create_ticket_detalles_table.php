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
        Schema::create('ticket_detalles', function (Blueprint $table) {
            $table->id('tickd_id');
            $table->unsignedBigInteger('tick_id');
            $table->unsignedBigInteger('usu_id');
            $table->text('tickd_descrip');
            $table->timestamp('fech_crea')->useCurrent();
            $table->timestamps();
        
            // Llaves foráneas
            $table->foreign('tick_id')->references('tick_id')->on('tickets')->onDelete('cascade');
            $table->foreign('usu_id')->references('usu_id')->on('usuarios');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_detalles');
    }
};
