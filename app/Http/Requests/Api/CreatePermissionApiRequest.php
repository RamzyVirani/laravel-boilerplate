<?php

namespace App\Http\Requests\API;

use App\Models\Permission;

/**
 * Class CreatePermissionApiRequest
 * @package App\Http\Requests\API
 */
class CreatePermissionApiRequest extends BaseAPIRequest
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
        return Permission::$rules;
    }
}
