<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmPrioridadTable extends Migration
{
    public function up()
    {
        Schema::create('tm_prioridad', function (Blueprint $table) {
            $table->id('prio_id');
            $table->string('prio_nom');
            $table->boolean('est')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tm_prioridad');
    }
}
