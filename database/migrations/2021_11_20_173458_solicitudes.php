<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Solicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->date('fecha');
            $table->bigInteger('empleados_id')->unsigned();
            $table->bigInteger('tipos_solicitud_id')->unsigned();
            $table->timestamps();
            $table->foreign('empleados_id')->references('id')->on('empleados');
            $table->foreign('tipos_solicitud_id')->references('id')->on('tipos_solicitud');
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
