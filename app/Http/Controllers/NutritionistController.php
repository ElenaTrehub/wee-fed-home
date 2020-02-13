<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NutritionistController extends Controller
{
    public function __construct()
    {

    }

    public function showCondition()
    {
        return view('public.nutritionist.condition');
    }

}
