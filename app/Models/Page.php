<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property string slug
 * @property string title
 * @property string content
 * @property integer status
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @property PageTranslation translations
 *
 * @SWG\Definition(
 *      definition="Page",
 *      required={"slug", "status"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="slug",
 *          description="slug",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      )
 * )
 */
class Page extends Model
{
    use SoftDeletes, Translatable, CascadeSoftDeletes;

    public $translatedAttributes = ['title', 'content'];
    protected $cascadeDeletes = ['translations'];
    protected $dates = ['deleted_at'];

    public $table = 'pages';

    public $fillable = [
        'slug',
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
        'slug'   => 'required|unique:pages,slug',
        'status' => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [

    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'slug'   => 'required|unique:pages,slug',
        'status' => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'slug'   => 'required|unique:pages,slug',
        'status' => 'required'
    ];
}