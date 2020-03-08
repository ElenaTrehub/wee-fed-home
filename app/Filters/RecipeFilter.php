<?php

namespace App\Filters;


use Psy\Util\Str;

class RecipeFilter{

    protected $builder;
    protected $request;
    protected $limit;
    protected $offset;
    protected $count;
    public function __construct($builder, $request, $count )
    {
        $this->builder = $builder;
        $this->request = $request;
        $this->count = $count;
    }

    public function apply(){


        foreach ($this->filters() as $filter => $value){
            if(method_exists($this, $filter)){

                $this->$filter($value);
            }
        }

        if($this->offset > ($this->count - $this->limit)){
            return 0;
        }
        else{
            $this->builder = array_slice($this->builder, $this->offset, $this->limit);
            //dd($this->builder);
            return $this->builder;
        }


    }

    public function filters(){

        return $this->request->all();

    }

    public function category($value){
        if($value === 'Выберите из списка') return;
        $recipes = [];
        foreach($this->builder as $obj){
            if($obj->recipe->idCategory == $value){
                $recipes[] = $obj;
            }
        }
        $this->builder = $recipes;
    }
    public function calory($value){
        if(!$value) return;
        $recipesCalory = [];
        foreach($this->builder as $obj){
            if($obj->recipe->calory < $value){
                $recipesCalory[] = $obj;
            }
        }
        $this->builder = $recipesCalory;
    }
    public function ingr($value){
        if(!$value) return;
        $recipesCalory = [];
        foreach($this->builder as $obj){
            foreach($obj->ingredients as $ingredient){

                if($ingredient->titleIngredient === mb_strtolower($value)){
                    $recipesCalory[] = $obj;
                }

            }
        }
        $this->builder = $recipesCalory;

    }
    public function limit($value){
        if(!$value) return;

        $this->limit = $value;

    }
    public function offset($value){
        if(!$value) return;

        $this->offset = $value;

    }
}
