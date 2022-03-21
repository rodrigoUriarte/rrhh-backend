<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('denominacion_social');
            $table->string('cuit');
            $table->string('email');
            $table->string('logo');
            $table->date('inicio_actividades');
            $table->string('clasificacion');
            $table->string('domicilio_legal');
            $table->string('domicilio_fiscal');
            $table->string('telefono');
            $table->string('moneda');
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
        Schema::dropIfExists('empresas');
    }
}
