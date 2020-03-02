<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('service_user');
        Schema::create('services_users', function (Blueprint $table) {
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
        Schema::dropIfExists('services_users');
    }
}
