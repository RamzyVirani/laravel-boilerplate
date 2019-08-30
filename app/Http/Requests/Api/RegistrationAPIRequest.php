<?php

namespace App\Http\Requests\Api;

use App\Models\Register;

/**
 * Class RegistrationAPIRequest
 * @package App\Http\Requests\Api
 */
class RegistrationAPIRequest extends BaseAPIRequest
{
    /**
     * Determine if the user is authorized to make this registration.
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
        return Register::$rules;
    }
}
