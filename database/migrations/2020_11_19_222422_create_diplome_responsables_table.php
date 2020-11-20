<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomeResponsablesTable extends Migration
{
    /**
     * Creation de la table diplome_responsables
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplome_responsables', function (Blueprint $table) {
            $table->id('idDiplomeResponsable');
            $table->unsignedBigInteger('idResponsable');
            $table->foreign('idResponsable')->references('id')->on('users');
            $table->unsignedBigInteger('idDiplome');
            $table->foreign('idDiplome')->references('idDiplome')->on('diplomes');
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
        Schema::dropIfExists('diplome_responsables');
    }
}
