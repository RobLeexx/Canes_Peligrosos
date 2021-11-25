<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->id();
            /* Canes */
            $table->string('numCanes');
            $table->string('aFechaHoraCanes');
            $table->string('aCanesFile');
            $table->string('aCanes', 150);
            /* Rejap */
            $table->string('numRejap');
            $table->string('aFechaHoraRejap');
            $table->string('aRejapFile');
            $table->string('aRejap', 150);
            /* Felcc */
            $table->string('numFelcc');
            $table->string('aFechaHoraFelcc');
            $table->string('aFelccFile');
            $table->string('aFelcc', 150);
            /* Felcn */
            $table->string('numFelcn');
            $table->string('aFechaHoraFelcn');
            $table->string('aFelcnFile');
            $table->string('aFelcn', 150);
            /* Felcv */
            $table->string('numFelcv');
            $table->string('aFechaHoraFelcv');
            $table->string('aFelcvFile');
            $table->string('aFelcv', 150);

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
        Schema::dropIfExists('antecedentes');
    }
}
