<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PageTranslation
 * @package App\Models
 *
 * @property integer id
 * @property integer page_id
 * @property string locale
 * @property string title
 * @property string content
 * @property integer status
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @property Page page
 * @property Language language
 */
class PageTranslation extends Model
{
    use SoftDeletes;

    public $table = 'page_translations';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'page_id',
        'locale',
        'title',
        'content',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'locale'  => 'string',
        'title'   => 'string',
        'content' => 'string',
        'status'  => 'boolean'
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
        'locale'  => 'required',
        'page_id' => 'required',
        'title'   => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'locale'  => 'required',
        'page_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'locale', 'code');
    }
}
