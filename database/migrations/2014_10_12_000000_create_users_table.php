<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->bigIncrements('idStatus')->unsigned();
            $table->string('titleStatus')->unique();

        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('userPhoto')->nullable();
            $table->integer('rating')->default(0);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->bigInteger('idStatus')->unsigned();
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();


            $table->foreign('idStatus')->references('idStatus')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        chema::dropIfExists('statuses');
        Schema::dropIfExists('users');
    }
}
