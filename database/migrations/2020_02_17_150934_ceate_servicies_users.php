<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CeateServiciesUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_user', function (Blueprint $table) {

            $table->unsignedBigInteger('idUser')->unsigned();
            $table->unsignedBigInteger('idService')->unsigned();

            $table->unique('idUser', 'idService');
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idService')->references('idService')->on('services');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_user');
    }
}
