<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookerbookRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cookerbook_recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idCookerBook')->unsigned();
            $table->foreign('idCookerBook')->references('idCookerBook')->on('cooker_books');
            $table->bigInteger('idRecipe')->unsigned();
            $table->foreign('idRecipe')->references('idRecipe')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cookerbook_recipes');
    }
}
