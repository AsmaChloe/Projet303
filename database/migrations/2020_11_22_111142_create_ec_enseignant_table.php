<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcEnseignantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ec_enseignant', function (Blueprint $table) {
            $table->id('idECEnseignant');
            $table->unsignedBigInteger('idEC');
            $table->foreign('idEC')->references('idEC')->on('e_c_s');
            $table->unsignedBigInteger('idEnseignant');
            $table->foreign('idEnseignant')->references('id')->on('users');
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
        Schema::dropIfExists('ec_enseignant');
    }
}
