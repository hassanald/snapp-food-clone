<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDiscountRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => "required|unique:discounts,title,{$this->discount}",
            'code' => "required|unique:discounts,code,{$this->discount}|min:5",
            'discount_percent' => 'required|digits_between:1,3',
            'expired_at' => 'required|date',
        ];
    }
}
