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
            $this->builder = $this->builder->slice($this->offset, $this->limit);
            //dd($this->builder);
            return $this->builder;
        }


    }

    public function filters(){

        return $this->request->all();

    }

    public function category($value){
        if(!$value) return;
        $this->builder = $this->builder->where('idCategory', $value);
        //dd($this->builder);
    }
    public function max_calory($value){
        if(!$value) return;
        $this->builder = $this->builder->where('calory', '<', $value);
    }
    public function ingr($value){
        if(!$value) return;

        $this->builder = $this->builder->filter(function($item) use ($value){
            if(mb_strpos($item->recipeIngredients, $value)){
                return true;
            }
        });
       // $this->builder = $this->builder->where('recipeIngredients', 'REGEXP', 'makaroni\s')->slice($this->offset, $this->limit);
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