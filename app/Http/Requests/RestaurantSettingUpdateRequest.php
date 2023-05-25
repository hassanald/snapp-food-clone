<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestaurantSettingUpdateRequest extends FormRequest
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
            'name' => ["required" , Rule::unique('restaurants')->ignore($this->restaurant->id)],
            'phone' => ['required' , Rule::unique('restaurants')->ignore($this->restaurant->id) , 'regex:/^[0-9]{9}/'],
            'address' => 'required|min:10|max:100',
            'acc_number' => ["required","digits:16" , Rule::unique('restaurants')->ignore($this->restaurant->id)],
            'restaurant_category_id' => 'required',
            'is_open' => 'nullable',
            'schedule' => 'nullable',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ];
    }
}
