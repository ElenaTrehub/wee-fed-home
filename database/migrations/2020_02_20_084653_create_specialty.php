<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialty', function (Blueprint $table) {
            $table->bigIncrements('idSpecialty');
            $table->bigInteger('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
            $table->string('titleSpecialty');
            $table->string('urlDiplom', 250);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialty');
    }
}
