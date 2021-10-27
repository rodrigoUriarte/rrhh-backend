<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('legajo');
            $table->string('apellido');
            $table->string('nombre');
            $table->string('dni');
            $table->date('fecha_nacimiento');
            $table->string('domicilio');
            $table->string('email');
            $table->string('telefono');
            $table->binary('foto_perfil');
            $table->char('sexo');
            $table->date('fecha_ingreso');
            $table->string('telefono_emergencia');
            $table->string('documentacion');
            $table->string('estado_civil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
