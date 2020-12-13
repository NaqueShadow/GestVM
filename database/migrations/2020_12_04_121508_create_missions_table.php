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

            $table->unsignedBigInteger('villeDepart');
            $table->unsignedBigInteger('villeDest');
            $table->unsignedBigInteger('transfert')->nullable();
            $table->unsignedBigInteger('demandeur'); // user-role:missionnaire

            $table->foreign('villeDepart')->references('id')->on('villes');
            $table->foreign('villeDest')->references('id')->on('villes');
            $table->foreign('demandeur')->references('id')->on('users');

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
