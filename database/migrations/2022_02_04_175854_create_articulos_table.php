<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('artLP')->nullable();
            $table->string('fileLP')->nullable();

            $table->string('artCB')->nullable();
            $table->string('fileCB')->nullable();

            $table->string('artSC')->nullable();
            $table->string('fileSC')->nullable();

            $table->string('artOR')->nullable();
            $table->string('fileOR')->nullable();

            $table->string('artSU')->nullable();
            $table->string('fileSU')->nullable();

            $table->string('artPT')->nullable();
            $table->string('filePT')->nullable();
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
        Schema::dropIfExists('articulos');
    }
}
