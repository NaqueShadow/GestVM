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
            $table->timestamp('acquisition')->nullable();
            $table->integer('statut')->default('1');
            $table->timestamp('dernierRetour')->nullable();

            $table->string('idChauf')->nullable();
            $table->char('idCateg')->nullable();
            $table->unsignedBigInteger('idPool')->nullable();
            $table->timestamps();

            $table->foreign('idPool')->references('id')->on('pools');
            $table->foreign('idCateg')->references('categorie')->on('categories');
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
