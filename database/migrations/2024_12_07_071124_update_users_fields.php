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
        Schema::table('users', function (Blueprint $table) {
            // Cambiar tipo de columna `rol` sin usar "CHECK"
            $table->string('rol')->default('cliente')->change();

            // Agregar manualmente la restricción `CHECK` para `rol`
            DB::statement("ALTER TABLE users ADD CONSTRAINT check_rol CHECK (rol IN ('admin', 'soporte', 'cliente'))");

            // Asegurar que el estado sea boolean y predeterminado en `false`
            $table->boolean('estado')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la restricción `CHECK` manualmente
            DB::statement("ALTER TABLE users DROP CONSTRAINT check_rol");

            // Revertir cambios en la columna `rol`
            $table->string('rol')->default(null)->change();

            // Revertir cambios en la columna `estado`
            $table->boolean('estado')->default(true)->change();
        });
    }
};
