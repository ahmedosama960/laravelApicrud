<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productValidate extends FormRequest
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
            "name"=>"required|max:80|unique:products|string",
            "notes"=>"required|max:460|string",
            "price"=>"required|numeric|min:1|max:1000"
        ];
    }

    public function messages()
    {
        return[
            "name.required"=>"the name field is absoultly required ! ",
            "name.max"=>"name must be smaller than 80 ",
            "name.unique"=>"name is not user before for another product !",
            "name.string"=>"the name must be string, don't change it",
            "notes.required"=>"the notes field is required !",
            "notes.max"=>"the max size is 460 ! keep it simmple",
            "notes.string"=>"the name must be string, don't change it",
            "price.required"=>"the price field is absoultly required ! ",
            "price.numeric"=>"the price field is must be a number ! ",
            "price.min"=>"the price can't be below 1$ !",
            "price.max"=>"the max price for now is 1000"
        ];
    }
}
