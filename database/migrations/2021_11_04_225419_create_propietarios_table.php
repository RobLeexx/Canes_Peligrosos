<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropietariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propietarios', function (Blueprint $table) {
            $table->id();
            $table->string('paterno');
            $table->string('materno');
            $table->string('nombres');
            $table->date('dateProp');
            $table->string('estCivil');
            $table->string('profesion');
            $table->string('docTipo');
            $table->string('documento');
            $table->string('docExp');
            $table->string('docFile')->nullable();
            $table->string('fotoProp');
            /* Domicilio */
            $table->string('departamento');
            $table->string('provincia');
            $table->string('municipio');
            $table->string('zona');
            $table->string('domicilio');
            $table->string('latitud');
            $table->string('longitud');
            /* Contactos */
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('contactoAlterno')->nullable();
            /* C.A.C */
            $table->string('cac');
            $table->string('grupo');
            $table->string('capacitacion');
            $table->string('creado_por');
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
        Schema::dropIfExists('propietarios');
    }
}
