<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_user', function (Blueprint $table) {

            $table->unsignedBigInteger('idUser')->unsigned();
            $table->unsignedBigInteger('idRole')->unsigned();

            $table->unique('idUser', 'idRole');
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idRole')->references('idRole')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_user');
    }
}
