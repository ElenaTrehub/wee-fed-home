<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDoctorLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_doctor_like', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
            $table->bigInteger('idDoctorInfo')->unsigned();
            $table->foreign('idDoctorInfo')->references('idDoctorInfo')->on('doctor_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_doctor_like');
    }
}
