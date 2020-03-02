<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_info', function (Blueprint $table) {
            $table->bigIncrements('idDoctorInfo');
            $table->bigInteger('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
            $table->string('surname', 250);
            $table->string('name', 250);
            $table->string('second_name', 250);
            $table->timestamp('birth');
            $table->string('phone', 50);
            $table->double('private_practice')->nullable()->unsigned();
            $table->double('med_practice')->nullable()->unsigned();
            $table->string('description', 2500);
            $table->string('passport', 250);
            $table->integer('rating')->unsigned()->default(0);
            $table->boolean('isConfirmed')->default(false);
            $table->timestamp('dayPay');
            $table->double('sumPay')->unsigned();
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_info');
    }
}
