<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupeEcs extends Migration
{
    /**
     * Creation de la table groupe_ecs
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe_ecs', function (Blueprint $table) {
            $table->id('idGroupeEC');
            $table->unsignedBigInteger('idEC');
            $table->foreign('idEC')->references('idEC')->on('e_c_s');
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
        Schema::dropIfExists('groupe_ecs');
    }
}
