<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->bigIncrements('idIngredient');
            $table->string('titleIngredient', 250);
            $table->integer('count')->unsigned();
            $table->bigInteger('idRecipe')->unsigned();
            $table->foreign('idRecipe')->references('idRecipe')->on('recipes');
            $table->bigInteger('idUnit')->unsigned();
            $table->foreign('idUnit')->references('idUnit')->on('units');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
