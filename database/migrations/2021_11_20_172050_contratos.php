<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contratos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('contratos', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->date('fecha');
            $table->bigInteger('empleados_id')->unsigned();
            $table->bigInteger('tipo_contratos_id')->unsigned();
            $table->bigInteger('cargos_id')->unsigned();
            $table->timestamps();
            $table->foreign('empleados_id')->references('id')->on('empleados');
            $table->foreign('tipo_contratos_id')->references('id')->on('tipo_contratos');
            $table->foreign('cargos_id')->references('id')->on('cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
