<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RolesUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idRole');
            $table->unsignedBigInteger('idUser');
            $table->unique(['idRole', 'idUser']);
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('idRole')->references('id')->on('roles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_users');
    }
}
