<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateECSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_c_s', function (Blueprint $table) {
            $table->id('idEC');
            $table->string('nomEC');
            $table->string('sigleEC');
            $table->unsignedBigInteger('idSemestre');
            $table->foreign('idSemestre')->references('idSemestre')->on('semestres');
            $table->integer('nbPoints');
            $table->integer('nbECTS');
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
        Schema::dropIfExists('e_c_s');
    }
}
