<?php

namespace App\Http\Requests\Api;

/**
 * @property mixed current_password
 * @property mixed password
 *
 * Class ChangePasswordAPIRequest
 * @package App\Http\Requests\Api
 */
class ChangePasswordAPIRequest extends BaseAPIRequest
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
            'current_password'      => 'required',
            'password'              => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ];
    }

}
