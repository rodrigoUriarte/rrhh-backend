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
            $table->string('cuil');
            $table->char('sexo');
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento');
            $table->string('domicilio');
            $table->string('email');
            $table->string('telefono');
            $table->string('foto_perfil')->nullable();
            $table->date('fecha_ingreso');
            $table->date('fecha_baja')->nullable();
            $table->string('estado_civil');
            $table->integer('cantidad_hijos')->nullable();
            $table->string('telefono_emergencia');
            $table->string('preocupacional');
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
        Schema::dropIfExists('empleados');
    }
}
