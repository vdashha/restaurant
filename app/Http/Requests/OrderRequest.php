<?php

namespace App\Http\Requests;

use App\Enums\DeliveryTypeEnum;
use App\Enums\PaymentMethodEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'regex:/^\+375 \(\d{2}\) \d{3}-\d{2}-\d{2}$/'],
            'ready_time' => 'required|date_format:H:i',
            'restaurant' => 'required_if:delivery_method, ' . DeliveryTypeEnum::PICKUP->value,
            'delivery_address' => 'required_if:delivery_method, ' . DeliveryTypeEnum::DELIVERY->value,
            'delivery_method' => Rule::enum(DeliveryTypeEnum::class),
            'payment_method' => Rule::enum(PaymentMethodEnum::class),
            'comment' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'phone.required' => 'Поле "Номер телефона" обязательно для заполнения.',
            'restaurant.required' => 'Выберите ресторан.',
            'payment_method.required' => 'Выберите метод оплаты.',
        ];
    }

}
