<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PoolUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pool_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPool');
            $table->unsignedBigInteger('idUser');
            $table->unique('idUser');
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('pool_users');
    }
}
