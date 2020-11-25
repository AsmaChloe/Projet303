<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantParcoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiant_parcours', function (Blueprint $table) {
            $table->id('idEtudiantParcours');
            $table->unsignedBigInteger('idEtudiant');
            $table->foreign('idEtudiant')->references('id')->on('users');
            $table->unsignedBigInteger('idParcours');
            $table->foreign('idParcours')->references('idParcours')->on('parcours');
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
        Schema::dropIfExists('etudiant_parcours');
    }
}
