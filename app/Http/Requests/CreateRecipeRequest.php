<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class CreateRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $user = auth()->user();
        return ($user->hasRole(1)&&$user->hasStatus(3));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'title' => 'required|min:3|max:250',
            'ingredients' => 'required|min:3|max:2500',
            'description' => 'required|min:3|max:2500',
            'photoRecipe' => 'nullable|image|mimes:jpeg,bmp,png,tmp',
            'category' => 'required',
            'timePrepare' => 'nullable|numeric',
            'calory' => 'nullable|numeric',
            'step.*.StepDescription' => 'nullable|string|min:3|max:2500',
            'step.*.StepPhoto' => 'nullable|image|mimes:jpeg,bmp,png,tmp'];

    }


    public function messages()
    {

        return [
            'title.required' => 'Название рецепта должно быть указано!',
            'title.min:3' => 'В названии рецепта должно быть не менее 3 символов!',
            'title.max:250' => 'В названии рецепта должно быть не более 250 символов!',
            'ingredients.required' => 'Ингридиенты должны быть указано!',
            'ingredients.min:3' => 'В ингридиентах должно быть не менее 3 символов!',
            'ingredients.max:250' => 'В ингридиентах должно быть не более 2500 символов!',
            'description.required' => 'Описание рецепта должно быть указано!',
            'description.min:3' => 'В описании рецепта должно быть не менее 3 символов!',
            'description.max:250' => 'В описании рецепта должно быть не более 2500 символов!',
            'photoRecipe.image' => 'Фото рецепта должно быть изображением!',
            'photoRecipe.mimes:jpeg,bmp,png,tmp' => 'Фото рецепта должно иметь только следующие расширения:jpeg,bmp,png,tmp!',
            'category.required' => 'Категория должна быть указана!',
            'timePrepare.numeric' => 'Время приготовления должно быть в числовом формате!',
            'calory.numeric' => 'Калории должны быть в числовом формате!',
            'step.*.StepDescription' => 'string|min:3|max:2500',
            'step.*.StepPhoto' => 'mimes:jpg,gif, png, svg|image'];

    }
}
