<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idRecipe')->unsigned();
            $table->foreign('idRecipe')->references('idRecipe')->on('recipes');
            $table->string('stepPhoto', 250)->nullable();
            $table->integer('stepNumber')->unsigned();
            $table->string('stepDescription', 2500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_steps');
    }
}
