<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('numero_empleado')->nullable()->after('apellido'); // Campo para el número de empleado
            $table->boolean('estado')->default(true)->after('numero_empleado'); // Campo para el estado del usuario
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['numero_empleado', 'estado']); // Elimina los campos si se revierte la migración
        });
    }
};
