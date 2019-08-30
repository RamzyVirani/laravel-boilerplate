<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Menu
 * @package App\Models
 *
 * @property integer id
 * @property string name
 * @property string icon
 * @property string slug
 * @property integer position
 * @property integer is_protected
 * @property integer static
 * @property integer status
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @SWG\Definition(
 *      definition="Menu",
 *      required={"name", "icon", "slug", "position", "is_protected", "static", "status"},
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="icon",
 *          description="icon",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="slug",
 *          description="slug",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="position",
 *          description="position",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="is_protected",
 *          description="is_protected",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="static",
 *          description="static",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer"
 *      )
 * )
 */
class Menu extends Model
{
    use SoftDeletes;

    public $table = 'menus';
    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'module_id',
        'icon',
        'slug',
        'position',
        'is_protected',
        'static',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The objects that should be append to toArray.
     *
     * @var array
     */
    protected $with = [];

    /**
     * The attributes that should be append to toArray.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be visible in toArray.
     *
     * @var array
     */
    protected $visible = [];

    /**
     * Validation create rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'name' => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'name' => 'required'
    ];


}
