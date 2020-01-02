<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Factory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use InfyOm\Generator\Utils\ResponseUtil;

/**
 * Class BaseAPIRequest
 * @package App\Http\Requests\Api
 */
class BaseAPIRequest extends FormRequest
{

    /**
     * @param Factory $factory
     * @return Validator
     */
    public function validator(Factory $factory)
    {
        /*
        // Use it like 'name' => 'required|custom_validation:arg1,arg2,arg3'
        Validator::extend('custom_validation', function ($attribute, $value, $params) {
            // $attribute will contain field name, i.e. name
            // $value will contain the value in the $attribute/name
            // $parameters will be an array of arguments passed
            // i.e. [0] => arg1, [1] => arg2, [2] => arg3 and so on
            // return true for valid and false for invalid
            return true;
        });
        */
        return $this->createDefaultValidator($factory);
    }

    /**
     * @param string $message
     * @param array $data
     * @param array $error
     *
     * @return array
     */
    public static function makeError($message, array $data = [], array $error = [])
    {
        return [
            'success' => false,
            'message' => $message,
            'data'    => $data,
            'errors'  => $error,
        ];
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $except = [];
        $except = new ValidationException($validator);
        $except->errorBag($this->errorBag)->redirectTo($this->getRedirectUrl());
        $except->status = 422;
        foreach ($except->errors() as $key => $error) {
            $errors[] = [
                'label'   => $key,
                'message' => $error[0]
            ];
        }
        $except->response = Response::json($this->makeError($errors[0]['message'], [], $errors), $except->status);
        throw $except;
    }
}