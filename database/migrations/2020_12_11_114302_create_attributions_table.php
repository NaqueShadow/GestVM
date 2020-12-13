<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributions', function (Blueprint $table) {
            $table->id();
            $table->boolean('statut');
            $table->timestamps();

            $table->unsignedBigInteger('idChauf');
            $table->string('idVehicule');
            $table->unsignedBigInteger('idMission');
            $table->unsignedBigInteger('idEntite');

            $table->foreign('idVehicule')->references('code')->on('vehicules');
            $table->foreign('idChauf')->references('matricule')->on('chauffeurs');
            $table->foreign('idMission')->references('id')->on('missions');
            $table->foreign('idEntite')->references('id')->on('entites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributions');
    }
}
