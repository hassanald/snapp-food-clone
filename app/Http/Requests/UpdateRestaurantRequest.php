<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
            'name' => "required|unique:restaurants,name,{$this->restaurant}",
            'phone' => ['required' , "unique:restaurants,phone,{$this->restaurant}" , 'regex:/^[0-9]{9}/'],
            'address' => 'required|min:10|max:100',
            'acc_number' => "required|digits:16|unique:restaurants,acc_number,{$this->restaurant}",
            'restaurant_category_id' => 'required',
        ];
    }
}
