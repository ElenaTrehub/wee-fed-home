<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('idMessage');
            $table->bigInteger('idSender')->unsigned();
            $table->foreign('idSender')->references('id')->on('users');
            $table->bigInteger('idTaker')->unsigned();
            $table->foreign('idTaker')->references('id')->on('users');
            $table->string('textMessage', 2500);
            $table->boolean('isRead')->default(false);
            $table->timestamp('createdAt');
            $table->timestamp('updatedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
