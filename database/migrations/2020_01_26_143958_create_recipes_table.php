<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('idRecipe');
            $table->bigInteger('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
            $table->string('recipeTitle', 250);
            $table->string('recipeIngredients', 2500);
            $table->string('recipePhoto', 250)->nullable();
            $table->string('recipeDescription', 2500);
            $table->bigInteger('idCategory')->unsigned();
            $table->foreign('idCategory')->references('idCategory')->on('categories');
            $table->integer('timePrepare')->nullable()->unsigned();
            $table->double('calory')->nullable()->unsigned();
            $table->integer('like')->unsigned()->default(0);;
            $table->integer('dislike')->unsigned()->default(0);;
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
        Schema::dropIfExists('recipes');
    }
}
