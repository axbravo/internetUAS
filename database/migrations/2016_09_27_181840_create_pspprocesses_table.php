<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePspprocessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pspprocesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero_Fases');
            $table->integer('numero_Plantillas');
            $table->integer('max_tam_plantilla');
            $table->integer('idespecialidad');
            $table->integer('idcurso');
            $table->integer('idCiclo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pspprocesses');
    }
}
