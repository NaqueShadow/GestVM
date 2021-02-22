<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntitesPools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entites_pools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPool');
            $table->unsignedBigInteger('idEntite');
            $table->unique(['idPool', 'idEntite']);
            $table->timestamps();

            $table->foreign('idEntite')->references('id')->on('entites')->cascadeOnDelete();
            $table->foreign('idPool')->references('id')->on('pools')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entites_pools');
    }
}
