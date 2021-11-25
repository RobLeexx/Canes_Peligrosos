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
            $table->string('docTipo');
            $table->string('documento');
            $table->string('docExp');
            $table->string('docFile')->nullable();
            $table->string('fotoProp');
            $table->string('domicilio');
            $table->string('latitud');
            $table->string('longitud');
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable()->unique();;
            $table->string('contactoAlterno')->nullable();
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
