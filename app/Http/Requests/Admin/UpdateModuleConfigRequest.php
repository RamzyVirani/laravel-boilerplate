<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModuleConfigRequest extends FormRequest
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
            'name.*' => 'All Name Fields Are Required',
            'label.*' => 'All Label Fields Are Required',
            'type.*' => 'All Type Fields Are Required',
            'validation.*' => 'All Validation Fields Are Required',
            'width.*' => 'Width Fields Are Required'
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
            'name.*' => 'required',
            'label.*' => 'required',
            'type.*' => 'required',
            'validation.*' => 'required',
            'width.*' => 'required',
        ];
    }
}
