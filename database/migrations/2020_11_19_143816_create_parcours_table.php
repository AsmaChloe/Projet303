<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcours', function (Blueprint $table) {
            $table->id('idParcours');
            $table->string('nomParcours');
            $table->string('sigleParcours');
            $table->unsignedBigInteger('idResponsable');
            $table->foreign('idResponsable')->references('id')->on('users');
            $table->unsignedBigInteger('idDiplome');
            $table->foreign('idDiplome')->references('idDiplome')->on('diplomes');
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
        Schema::dropIfExists('parcours');
    }
}
