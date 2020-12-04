<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpreuvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epreuves', function (Blueprint $table) {
            $table->id('idEpreuve');
            $table->date('dateEpreuve');
            $table->time('debutEpreuve');
            $table->time('finEpreuve');
            $table->integer('numSession');
            $table->integer('pourcentage');
            $table->unsignedBigInteger('idEC');
            $table->foreign('idEC')->references('idEC')->on('e_c_s');
            $table->unsignedBigInteger('idTypeEpreuve');
            $table->foreign('idTypeEpreuve')->references('idTypeEpreuve')->on('type_epreuves');
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
        Schema::dropIfExists('epreuves');
    }
}
