<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property integer user_id
 * @property string platform
 * @property string client_id
 * @property string token
 * @property string username
 * @property string email
 * @property string expires_at
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @property User user
 *
 * @SWG\Definition(
 *      definition="SocialAccounts",
 *      required={"platform", "client_id", "token", "username", "email", "expires_at", "image"},
 *      @SWG\Property(
 *          property="platform",
 *          description="platform",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="client_id",
 *          description="client_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="token",
 *          description="token",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="username",
 *          description="username",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="device_token",
 *          description="User Device Token",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="device_type",
 *          description="User Device Type:ios,android,web",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="expires_at",
 *          description="expires_at",
 *          type="string",
 *      )
 * )
 */
class SocialAccount extends Model
{
    use SoftDeletes;
    public $table = 'user_social_accounts';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'platform',
        'client_id',
        'token',
        'expires_at',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $visible = [];

    protected $with = [];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'platform'     => 'required',
        'client_id'    => 'required',
        'token'        => 'required',
        'device_type'  => 'required|in:ios,android,web',
        'device_token' => 'sometimes|required',
        'username'     => 'sometimes|required',
        'email'        => 'sometimes|required|email',
        'image'        => 'sometimes|required|mimes:jpeg,jpg,png',
        'expires_at'   => 'sometimes|required|date_format:"Y-m-d H:i:s"',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}