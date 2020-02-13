<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'max_calory' => 'nullable|numeric',
            'ingr' => 'nullable|string|min:3|max:250'
        ];
    }

    public function messages()
    {

        return [

            'max_calory.numeric' => 'Время приготовления должно быть в числовом формате!',
            'ingr.string' => 'Ингридиенты должны быть в строковом формате!',
            'ingr.min:3' => 'В названии ингридиента должно быть не менее 3 символов!',
            'ingr.max:250' => 'В названии ингридиента должно быть не более 250 символов'];

    }
}
