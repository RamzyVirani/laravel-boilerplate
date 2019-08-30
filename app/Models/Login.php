<?php

namespace App\Models;

/**
 * Class Login
 * @package App\Models
 *
 * @SWG\Definition(
 *      definition="Login",
 *      required={"email", "password", "device_type", "device_token"},
 *      @SWG\Property(
 *          property="email",
 *          description="User Email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="device_type",
 *          description="device_type: ios,android,web",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="device_token",
 *          description="device_token",
 *          type="string"
 *      )
 * )
 */
class Login
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email'        => 'required|email',
        'password'    => 'required',
        'device_token' => 'sometimes|required',
        'device_type' => 'required|string|in:ios,android,web',
    ];

}