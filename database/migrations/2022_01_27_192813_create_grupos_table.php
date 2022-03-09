<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('capacitador')->nullable();
            $table->string('integrantes')->nullable();
            $table->string('tipo')->nullable();
            $table->string('turno')->nullable();
            $table->string('horario')->nullable();
            $table->string('inicio')->nullable();
            $table->string('fin')->nullable();
            $table->string('completos')->nullable();
            $table->string('incompletos')->nullable();
            $table->string('observados')->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('grupos');
    }
}
