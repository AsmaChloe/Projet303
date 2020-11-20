<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupeEnseignantsTable extends Migration
{
    /**
     * Creation de la table groupe_enseignants
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe_enseignants', function (Blueprint $table) {
            $table->id('idGroupeEns');
            $table->unsignedBigInteger('idEnseignant');
            $table->foreign('idEnseignant')->references('id')->on('users');
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
        Schema::dropIfExists('groupe_enseignants');
    }
}
