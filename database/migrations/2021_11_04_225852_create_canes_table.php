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
            $table->string('fotoCan')->nullable();
            $table->string('fotoCan2')->nullable();
            $table->string('razaCan');
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
