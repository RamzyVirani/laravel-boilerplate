<?php

namespace App\Http\Requests\Api;

use App\Models\Menu;

/**
 * Class UpdateMenuAPIRequest
 * @package App\Http\Requests\Api
 */
class UpdateMenuAPIRequest extends BaseAPIRequest
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
        return Menu::$rules;
    }
}
