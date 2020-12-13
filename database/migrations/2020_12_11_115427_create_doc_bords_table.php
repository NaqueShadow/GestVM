<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocBordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_bords', function (Blueprint $table) {
            $table->unsignedBigInteger('code')->primary();
            $table->integer('type');
            $table->string('lieus');
            $table->boolean('statut');
            $table->timestamp('etabl');
            $table->timestamp('exp');
            $table->timestamps();

            $table->string('idVehicule');

            $table->foreign('idVehicule')->references('code')->on('vehicules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_bords');
    }
}
