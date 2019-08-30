<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property string code
 * @property string title
 * @property string native_name
 * @property string direction
 * @property integer status
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @property SettingTranslation setting_translations
 *
 * @SWG\Definition(
 *      definition="Language",
 *      required={"code", "title", "native_name", "direction", "status"},
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="native_name",
 *          description="native_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="direction",
 *          description="direction",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer"
 *      )
 * )
 */
class Language extends Model
{
    use SoftDeletes;

    public $table = 'locales';
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'code';

    public $fillable = [
        'code',
        'title',
        'native_name',
        'direction',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string'
    ];

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
        'code'        => 'required',
        'title'       => 'required',
        'native_name' => 'required',
        'direction'   => 'required',
        'status'      => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'code'        => 'required',
        'title'       => 'required',
        'native_name' => 'required',
        'direction'   => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'code'        => 'required',
        'title'       => 'required',
        'native_name' => 'required',
        'direction'   => 'required',
        'status'      => 'required'
    ];


}
