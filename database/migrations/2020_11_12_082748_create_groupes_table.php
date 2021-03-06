<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupesTable extends Migration
{
    /**
     * Creation de la table groupes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupes', function (Blueprint $table) {
            $table->id('idGroupe');
            $table->string('nomGroupe');
            $table->string('typeGroupe');
            $table->timestamps();
        });
    }

    /**
     * Rollback de migration
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupes');
    }
}
