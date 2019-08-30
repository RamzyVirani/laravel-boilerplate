<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property string default_language
 * @property string email
 * @property string logo
 * @property string phone
 * @property float latitude
 * @property float longitude
 * @property string playstore
 * @property string appstore
 * @property string social_links
 * @property float app_version
 * @property integer force_update
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @property string image_url
 *
 * @SWG\Definition(
 *      definition="Setting",
 *      required={"default_language", "email", "logo", "phone", "latitude", "longitude", "playstore", "appstore", "social_links", "app_version", "force_update"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="default_language",
 *          description="default_language",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="logo",
 *          description="logo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="latitude",
 *          description="latitude",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="longitude",
 *          description="longitude",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="playstore",
 *          description="playstore",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="appstore",
 *          description="appstore",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="social_links",
 *          description="social_links",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="app_version",
 *          description="app_version",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="force_update",
 *          description="force_update",
 *          type="string"
 *      )
 * )
 */
class Setting extends Model
{
    use SoftDeletes, Translatable, CascadeSoftDeletes;

    public $table = 'settings';

    protected $dates = ['deleted_at'];
    public $translatedAttributes = ['title', 'address', 'about'];
    protected $cascadeDeletes = ['translations'];

    public $fillable = [
        'default_language',
        'email',
        'logo',
        'phone',
        'latitude',
        'longitude',
        'playstore',
        'appstore',
        'social_links',
        'app_version',
        'force_update'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'default_language' => 'string',
        'email'            => 'string',
        'logo'             => 'string',
        'phone'            => 'string',
        'latitude'         => 'string',
        'longitude'        => 'string',
        'playstore'        => 'string',
        'appstore'         => 'string',
        'social_links'     => 'string',
        'app_version'      => 'float',
        'force_update'     => 'string'
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
        'default_language' => 'required|exists:locales,code',
        'email'            => 'required|email',
        'logo'             => 'required|image|mimetypes:jgp,jgep,png',
        'phone'            => 'required',
        'latitude'         => 'required',
        'longitude'        => 'required',
        'playstore'        => 'required',
        'appstore'         => 'required',
        'social_links'     => 'required',
        'app_version'      => 'required',
        'force_update'     => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'default_language' => 'required|exists:locales,code',
        'email'            => 'required|email',
        'logo'             => 'sometimes|required',
        'phone'            => 'required',
        'latitude'         => 'required',
        'longitude'        => 'required',
        'playstore'        => 'required',
        'appstore'         => 'required',
        'app_version'      => 'required',
        'force_update'     => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'default_language' => 'required|exists:locales,code',
        'email'            => 'required|email',
        'logo'             => 'required|image|mimetypes:jgp,jgep,png',
        'phone'            => 'required',
        'latitude'         => 'required',
        'longitude'        => 'required',
        'playstore'        => 'required',
        'appstore'         => 'required',
        'social_links'     => 'required',
        'app_version'      => 'required',
        'force_update'     => 'required'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'default_language' => 'required|exists:locales,code',
        'email'            => 'required|email',
        'logo'             => 'required',
        'phone'            => 'required',
        'latitude'         => 'required',
        'longitude'        => 'required',
        'playstore'        => 'required',
        'appstore'         => 'required',
        'social_links'     => 'required',
        'app_version'      => 'required',
        'force_update'     => 'required'
    ];

    /**
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return ($this->logo && storage_path(url('storage/app/' . $this->logo))) ? route('api.resize', ['img' => $this->logo, 'w=100', 'h=100']) : route('api.resize', ['img' => 'public/logo.png', 'w=100', 'h=100']);
    }
}
