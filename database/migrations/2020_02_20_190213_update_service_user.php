<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateServiceUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_user', function (Blueprint $table) {

            $table->bigInteger('idUser')->unsigned();
            $table->bigInteger('idService')->unsigned();

            $table->unique(['idUser', 'idService']);
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idService')->references('idService')->on('services');
            $table->double('sum')->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_user');
    }

}
