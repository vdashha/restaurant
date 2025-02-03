<?php

namespace App\Http\Requests\Courier;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'patronymic' => 'required|string',
            'password' => 'required|string|confirmed',
            'phone' => 'required|string|unique:couriers,phone'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле обязательно для заполнения',
            'surname.required' => 'Поле обязательно для заполнения',
            'patronymic.required' => 'Поле обязательно для заполнения',
            'password.required' => 'Поле обязательно для заполнения',
            'phone.required' => 'Поле обязательно для заполнения',
            'phone.unique' => 'Номер телефона должен быть уникальный',
        ];
    }
}
