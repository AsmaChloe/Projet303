<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnseignantGroupeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignant_groupe', function (Blueprint $table) {
            $table->id('idEnseignantGroupe');
            $table->unsignedBigInteger('idEnseignant');
            $table->foreign('idEnseignant')->references('id')->on('users');
            $table->unsignedBigInteger('idGroupe');
            $table->foreign('idGroupe')->references('idGroupe')->on('groupes');
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
        Schema::dropIfExists('enseignant_groupe');
    }
}
