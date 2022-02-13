<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cans', function (Blueprint $table) {
            $table->id();
            $table->string('nomPerro');
            $table->string('dateNacPerro');
            $table->string('sexoCan');
            $table->string('procedenciaCan');

            $table->string('fotoCan1')->nullable();
            $table->string('fotoCan2')->nullable();
            $table->string('fotoCan3')->nullable();
            $table->string('fotoCan4')->nullable();
            $table->string('fotoCan5')->nullable();

            $table->string('pedigree')->nullable();
            $table->string('razaCan');
            $table->string('tamCan');
            $table->string('colorCan');
            $table->string('sinCan')->nullable();

            $table->string('antecedentesCan')->nullable();
            $table->string('tipoAnt')->nullable();
            $table->string('numAnt')->nullable();
            $table->string('fechaHoraAnt')->nullable();
            $table->string('canAntFile')->nullable();
            $table->string('canAnt')->nullable();

            $table->string('vacuna')->nullable();
            $table->string('dateVacPerro')->nullable();
            $table->string('esterilizacion')->nullable();
            $table->string('dateEstPerro')->nullable();
            $table->string('mismoVeterinario')->nullable();

            $table->string('vetNom1')->nullable();
            $table->string('vetUbi1')->nullable();
            $table->string('vetRes1')->nullable();
            $table->string('vetNum1')->nullable();
            $table->string('vacFile')->nullable();

            $table->string('vetNom2')->nullable();
            $table->string('vetUbi2')->nullable();
            $table->string('vetRes2')->nullable();
            $table->string('vetNum2')->nullable();
            $table->string('estFile')->nullable();

            $table->string('vetNom3')->nullable();
            $table->string('vetUbi3')->nullable();
            $table->string('vetRes3')->nullable();
            $table->string('vetNum3')->nullable();

            $table->string('numMicro')->nullable();
            $table->string('canEven1');
            $table->string('canEvenNum1');
            $table->string('canEven2')->nullable();
            $table->string('canEvenNum2')->nullable();
            $table->string('canEven3')->nullable();
            $table->string('canEvenNum3')->nullable();
            $table->string('canEven4')->nullable();
            $table->string('canEvenNum4')->nullable();
            $table->string('canConvivencia');

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
        Schema::dropIfExists('cans');
    }
}
