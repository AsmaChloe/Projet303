<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcoursEcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcours_ec', function (Blueprint $table) {
            $table->id('idParcoursEC');
            $table->unsignedBigInteger('idParcours');
            $table->foreign('idParcours')->references('idParcours')->on('parcours');
            $table->unsignedBigInteger('idEC');
            $table->foreign('idEC')->references('idEC')->on('e_c_s');
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
        Schema::dropIfExists('parcours_ec');
    }
}
