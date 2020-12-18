<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChauffeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chauffeurs', function (Blueprint $table) {
            $table->unsignedBigInteger('matricule')->primary();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->unique();
            $table->boolean('statut')->default('1');
            $table->unsignedBigInteger('idPool')->default('1');
            $table->timestamps();

            $table->foreign('idPool')->references('id')->on('pools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chauffeurs');
    }
}
