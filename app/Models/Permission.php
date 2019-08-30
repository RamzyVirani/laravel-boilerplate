<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\EntrustPermission;

/**
 * Class Permission
 * @package App\Models
 *
 * @property integer id
 * @property string name
 * @property string display_name
 * @property string description
 * @property integer is_protected
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @SWG\Definition(
 *      definition="Permission",
 *      required={"name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Permission extends EntrustPermission
{
    use SoftDeletes;

    public $table = 'permissions';
    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
		'module_id',
        'display_name',
        'description'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}