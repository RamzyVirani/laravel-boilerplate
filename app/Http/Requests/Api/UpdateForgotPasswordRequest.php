<?php

namespace App\Http\Requests\Api;

/**
 * Class UpdateForgotPasswordRequest
 * @package App\Http\Requests\Api
 */
class UpdateForgotPasswordRequest extends BaseAPIRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'verification_code' => 'required',
            'email'             => 'required|email|exists:password_resets,email',
            'password'          => 'required'
        ];
    }

}
