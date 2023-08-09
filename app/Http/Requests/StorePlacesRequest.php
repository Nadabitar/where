<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlacesRequest extends FormRequest
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
            'categoryId' => 'required' ,
            'subCategoryId' =>'nullable' ,
            'placeName' => 'required|string' ,
            'phoneNumber' => 'required|string' ,
            'addtionalPhone' => 'Nullable|string',
            'details' => 'nullable' , 
            'workTime' => 'required|string',
            'facebook' => 'Nullable|string',
            'whats' => 'Nullable|string',
            'instagram' => 'Nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'tags' => 'nullable' ,
        ];
    }
    

    public function massge()
    {
        //  if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
    }

}

