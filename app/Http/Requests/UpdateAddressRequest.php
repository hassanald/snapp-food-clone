<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'title' => 'nullable|string|min:3|max:20',
            'address' => 'nullable|string|min:5',
//            'latitude' => 'nullable|numeric',
//            'longitude' => 'nullable|numeric',
            'is_current' => 'nullable'
        ];
    }
}
