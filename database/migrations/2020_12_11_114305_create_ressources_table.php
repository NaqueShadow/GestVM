<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRessourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ressources', function (Blueprint $table) {
            $table->id();
            $table->decimal('carburant')->default('0');
            $table->decimal('comptDepart')->default('0');
            $table->decimal('comptRetour')->default('0');
            $table->timestamps();

            $table->unsignedBigInteger('idAttr');

            $table->foreign('idAttr')
                ->references('id')
                ->on('Attributions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ressources');
    }
}
