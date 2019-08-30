<?php

namespace App\Http\Requests\Api;

use App\Models\Login;

/**
 * Class LoginAPIRequest
 * @package App\Http\Requests\Api
 */
class LoginAPIRequest extends BaseAPIRequest
{
    /**
     * Determine if the user is authorized to make this registration.
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
        return Login::$rules;
    }
}