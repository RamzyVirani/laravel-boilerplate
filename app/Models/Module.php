<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Module
 * @package App\Models
 *
 * @property integer id
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 */
class Module extends Model
{
    use SoftDeletes;
    public $table = 'modules';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'table_name', 'name', 'slug', 'icon', 'config', 'menu', 'is_module', 'status'
    ];
}
