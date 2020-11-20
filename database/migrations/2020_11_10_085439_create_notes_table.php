<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id('idNote');
            $table->integer('valeurNote');
            $table->integer('maxNote');
            $table->unsignedBigInteger('idEtudiant');
            $table->foreign('idEtudiant')->references('id')->on('users');
            $table->unsignedBigInteger('idEpreuve');
            $table->foreign('idEpreuve')->references('idEpreuve')->on('epreuves');
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
        Schema::dropIfExists('notes');
    }
}
