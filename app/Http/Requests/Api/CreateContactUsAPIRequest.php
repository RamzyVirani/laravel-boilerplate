<?php

namespace App\Http\Requests\Api;

use App\Models\ContactUs;

/**
 * Class CreateContactUsAPIRequest
 * @package App\Http\Requests\Api
 */
class CreateContactUsAPIRequest extends BaseAPIRequest
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
        return ContactUs::$rules;
    }
}
