<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupeEtudiantsTable extends Migration
{
    /**
     * Creation de la table groupe_etudiants
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe_etudiants', function (Blueprint $table) {
            $table->id('idGroupeEtu');
            $table->unsignedBigInteger('idEtudiant');
            $table->foreign('idEtudiant')->references('id')->on('users');
            $table->unsignedBigInteger('idGroupe');
            $table->foreign('idGroupe')->references('idGroupe')->on('groupes');
            $table->timestamps();
        });
    }

    /**
     * Rollback
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupe_etudiants');
    }
}
