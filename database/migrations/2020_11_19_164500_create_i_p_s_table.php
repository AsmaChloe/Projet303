<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIPSTable extends Migration
{
    /**
     * Creation de la table i_p_s
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_p_s', function (Blueprint $table) {
            $table->id('idIP');
            $table->unsignedBigInteger('idEC');
            $table->foreign('idEC')->references('idEC')->on('e_c_s');
            $table->unsignedBigInteger('idEtudiant');
            $table->foreign('idEtudiant')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Inverser la migration
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_p_s');
    }
}
