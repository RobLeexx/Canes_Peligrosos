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
            $table->string('aCanesFile')->nullable();
            $table->string('aCanes', 150);
            /* Rejap */
            $table->string('numRejap');
            $table->string('aFechaHoraRejap');
            $table->string('aRejapFile')->nullable();
            $table->string('aRejap', 150);
            /* Felcc */
            $table->string('numFelcc');
            $table->string('aFechaHoraFelcc');
            $table->string('aFelccFile')->nullable();
            $table->string('aFelcc', 150);
            /* Felcn */
            $table->string('numFelcn');
            $table->string('aFechaHoraFelcn');
            $table->string('aFelcnFile')->nullable();
            $table->string('aFelcn', 150);
            /* Felcv */
            $table->string('numFelcv');
            $table->string('aFechaHoraFelcv');
            $table->string('aFelcvFile')->nullable();
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
