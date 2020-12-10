<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomesTable extends Migration
{
    /**
     * Creation de la table diplomes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplomes', function (Blueprint $table) {
            $table->id('idDiplome');
            $table->string('typeDiplome'); //Licence, Master,...
            $table->string('nomDiplome'); //Informatique, Mathématiques...
            $table->string('sigleDiplome'); //INFO, MA...
            $table->softDeletes();
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
        Schema::dropIfExists('diplomes');
    }
}
