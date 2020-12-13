<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentMissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missionnaires', function (Blueprint $table) {
            $table->unsignedBigInteger('agentId');
            $table->unsignedBigInteger('missionId');
            $table->primary(['agentId', 'missionId']);
            $table->foreign('agentId')->references('matricule')->on('agents');
            $table->foreign('missionId')->references('id')->on('missions');

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
        Schema::dropIfExists('missionnaires');
    }
}
