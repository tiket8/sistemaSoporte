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
        // Agrega la columna 'prio_id' como clave foránea
        $table->unsignedBigInteger('prio_id')->after('tick_descrip')->nullable();

        // Clave foránea que referencia la tabla 'tm_prioridad'
        $table->foreign('prio_id')->references('prio_id')->on('tm_prioridad');
    });
}

public function down()
{
    Schema::table('tickets', function (Blueprint $table) {
        // Elimina la clave foránea y la columna
        $table->dropForeign(['prio_id']);
        $table->dropColumn('prio_id');
    });
}
};
