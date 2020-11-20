<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcEnseignantsTable extends Migration
{
    /**
     * Creation de la table ec_enseignants
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ec__enseignants', function (Blueprint $table) {
            $table->id('idECEnseignant');
            $table->unsignedBigInteger('idEC');
            $table->foreign('idEC')->references('idEC')->on('e_c_s');
            $table->unsignedBigInteger('idEnseignant');
            $table->foreign('idEnseignant')->references('id')->on('users');
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
        Schema::dropIfExists('ec__enseignants');
    }
}
