<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->index();
            $table->unsignedBigInteger('idPool');
            $table->foreign('idPool')->references('id')->on('pools')->cascadeOnDelete();
            $table->foreign('matricule')->references('matricule')->on('agents')->cascadeOnDelete();
            $table->string('login')->unique();
            $table->string('password');
            $table->integer('role')->default(1);
            $table->integer('statut')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
