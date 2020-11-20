<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcoursSemestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcours_semestres', function (Blueprint $table) {
            $table->id('idParcoursSemestre');
            $table->unsignedBigInteger('idParcours');
            $table->foreign('idParcours')->references('idParcours')->on('parcours');
            $table->unsignedBigInteger('idSemestre');
            $table->foreign('idSemestre')->references('idSemestre')->on('semestres');
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
        Schema::dropIfExists('parcours_semestres');
    }
}
