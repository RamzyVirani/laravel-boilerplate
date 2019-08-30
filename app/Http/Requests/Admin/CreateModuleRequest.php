<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateModuleRequest extends FormRequest
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

    public function messages()
    {
        return [
            'table_name.required' => 'Please Select table',
            'module.required' => 'Please Enter Module Name',
            'icon.required' => 'Select Icon',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'table_name' => 'required',
            'module' => 'required',
            'icon' => 'required'
        ];
    }
}
