<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDoctorRequest extends FormRequest
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
            'surname' => 'required|min:3|max:250',
            'name' => 'required|min:3|max:250',
            'second_name' => 'required|min:3|max:250',
            'birth' => 'required|after:1920-01-01|before:2003-01-01',
            'phone' => 'required|regex:/^\+380\d{9}$/',
            'diplom.*.diplomSpecialty' => 'nullable|string|min:3|max:2500',
            'diplom.*.DiplomPhoto' => 'nullable|image|mimes:jpeg,bmp,png,tmp',
            'services' => 'required|string|min:3|max:2500',
            'private_practice' => 'nullable|numeric',
            'med_practice' => 'nullable|numeric',
            'description' => 'required|string|min:3|max:2500',
            'passport' => 'required|image|mimes:jpeg,bmp,png,tmp',
            ];

    }
    public function messages()
    {

        return [
            'surname.required' => 'Фамилия должна быть указано!',
            'surname.min:3' => 'В фамилии должно быть не менее 3 символов!',
            'surname.max:250' => 'В фамилии должно быть не более 250 символов!',
            'name.required' => 'Имя должна быть указано!',
            'name.min:3' => 'В имени должно быть не менее 3 символов!',
            'name.max:250' => 'В имени должно быть не более 250 символов!',
            'second_name.required' => 'Отчество должна быть указано!',
            'second_name.min:3' => 'В отчестве должно быть не менее 3 символов!',
            'second_name.max:250' => 'В отчестве должно быть не более 250 символов!',
            'birth.required' => 'Дата рождения должна быть указано!',
            'birth.after:1920-01-01' => 'Вам больше 100 лет? Дата рождения указана неверно!',
            'birth.before:2003-01-01' => 'Вам меньше 18 лет!',
            'phone.required' => 'Телефон должен быть указан!',
            'phone.regex:/(+380)[0-9]{9}/' => 'Введите телефон в указанном формате!',
            'diplom.*.diplomSpecialty.string' => 'Наименование специальности должно быть строкой',
            'diplom.*.diplomSpecialty.min:3' => 'Наименование специальности должно состоять не менее чем из 3 символов',
            'diplom.*.diplomSpecialty.max:2500' => 'Наименование специальности должно состоять не более чем из 2500 символов',
            'diplom.*.DiplomPhoto.image' => 'Фото диплома должно быть изображением!',
            'diplom.*.DiplomPhoto.mimes:jpeg,bmp,png,tmp' => 'Фото диплома должно иметь только следующие расширения:jpeg,bmp,png,tmp!',
            'services.required' => 'Услуги должны быть указаны!',
            'services.min:3' => 'В услугах должно быть не менее 3 символов!',
            'services.max:2500' => 'В услугах должно быть не более 2500 символов!',
            'private_practice.numeric' => 'Частная практика должны быть в числовом формате!',
            'med_practice.numeric' => 'Медицинская практика должны быть в числовом формате!',
            'description.required' => 'Описание должно быть указано!',
            'description.min:3' => 'В описании должно быть не менее 3 символов!',
            'description.max:2500' => 'В описании должно быть не более 2500 символов!',
            'passport.image' => 'Фото Вас с паспортом должно быть изображением!',
            'passport.mimes:jpeg,bmp,png,tmp' => 'Фото вас с паспортом должно иметь только следующие расширения:jpeg,bmp,png,tmp!'];

    }
}
