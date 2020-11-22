<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentiels', function (Blueprint $table) {
            $table->id('idPresentiel');
            $table->unsignedBigInteger('idSeance');
            $table->foreign('idSeance')->references('idSeance')->on('seances');
            $table->unsignedBigInteger('idEtudiant');
            $table->foreign('idEtudiant')->references('id')->on('users');
            $table->unsignedBigInteger('idType');
            $table->foreign('idType')->references('idType')->on('type_presentiels');
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
        Schema::dropIfExists('presentiels');
    }
}
