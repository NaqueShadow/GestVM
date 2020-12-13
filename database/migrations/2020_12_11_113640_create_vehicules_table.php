<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('immatriculation')->unique();
            $table->string('modele');
            $table->integer('etat');
            $table->timestamp('dernierRetour');
            $table->timestamps();

            $table->unsignedBigInteger('idChauf');
            $table->unsignedBigInteger('idPool');

            $table->foreign('idPool')->references('id')->on('pools');
            $table->foreign('idChauf')->references('matricule')->on('chauffeurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicules');
    }
}
