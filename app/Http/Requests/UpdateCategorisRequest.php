<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategorisRequest extends FormRequest
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
            'name' => 'string|required',
            'isParent' => 'sometimes',
            'parentId' => 'nullable',
            'status' => 'nullable|in:active,unactive',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];
    }
}
