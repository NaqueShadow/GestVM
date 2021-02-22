<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('objet');
            $table->string('commentaire')->nullable();
            $table->timestamp('dateDepart');
            $table->timestamp('dateRetour');
            $table->smallInteger('validation')->default('0');

            $table->string('typeV')->nullable();
            $table->string('codeV')->nullable();
            $table->string('idChauf')->nullable();

            $table->unsignedBigInteger('villeDepart');
            $table->unsignedBigInteger('villeDest');
            $table->unsignedBigInteger('idValideur')->nullable();
            $table->unsignedBigInteger('idEntite')->nullable();
            $table->string('idActivite')->nullable();
            $table->unsignedBigInteger('idPool')->nullable();
            $table->unsignedBigInteger('demandeur');

            $table->foreign('villeDepart')->references('id')->on('villes')->cascadeOnDelete();
            $table->foreign('villeDest')->references('id')->on('villes')->cascadeOnDelete();
            $table->foreign('idValideur')->references('id')->on('users')->nullOnDelete();
            $table->foreign('idEntite')->references('id')->on('entites')->nullOnDelete();
            $table->foreign('idPool')->references('id')->on('pools')->nullOnDelete();
            $table->foreign('idActivite')->references('code')->on('activites')->nullOnDelete();
            $table->foreign('demandeur')->references('id')->on('users')->cascadeOnDelete();

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
        Schema::dropIfExists('missions');
    }
}
