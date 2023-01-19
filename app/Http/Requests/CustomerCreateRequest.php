<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|numeric',
            'birth' => 'required|date',
            'street' => 'required',
            'number' => 'required|numeric',
            'neighborhood' => 'required',
            'zip_code' => 'required',
        ];
    }
}
