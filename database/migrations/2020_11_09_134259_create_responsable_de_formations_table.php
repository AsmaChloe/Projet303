<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsableDeFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable_de_formations', function (Blueprint $table) {
            $table->id('RefResponsable');
            $table->string('NomResponsable',50);
            $table->string('PrenomResponsable',50);
            $table->datetime('DateNaissanceResp');
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
        Schema::dropIfExists('responsable_de_formations');
    }
}
