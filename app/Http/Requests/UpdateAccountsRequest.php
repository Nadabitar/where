<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountsRequest extends FormRequest
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
            'email' => 'required|string|exits:users|email',
            'fullName' => 'required|string',
            'gender' => 'required|in:male,famle',
            'phone' => 'required|numeric|unique:users|starts_with:09,+963,00963',
            'regionId' => 'nullable|integer' ,
            'streetId' => 'nullable|integer',
        ];
    }
}
