<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguros', function (Blueprint $table) {
            $table->id();
            $table->string('nomAgencia');
            $table->string('ubiAgencia');
            $table->date('dateExpSeg');
            $table->date('dateLimSeg');
            $table->string('resAgencia')->nullable();
            $table->string('resAgenciaNum')->nullable();
            $table->string('seguroFile')->nullable();
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
        Schema::dropIfExists('seguros');
    }
}
