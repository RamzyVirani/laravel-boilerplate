<?php

namespace App\Repositories\Admin;

use App\Models\Role;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RoleRepository
 * @package App\Repositories\Admin
 * @version April 2, 2018, 7:48 am UTC
 *
 * @method Role findWithoutFail($id, $columns = ['*'])
 * @method Role find($id, $columns = ['*'])
 * @method Role first($columns = ['*'])
*/
class RoleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'display_name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
    }

    public function attachPermission($roleId, $permissionName){
        $role = $this->findWithoutFail($roleId);
        $role->perms()->attach($permissionName);
        $role->save();
    }
    public function detachPermission($roleId, $permissionName){
        $role = $this->findWithoutFail($roleId);
        $role->perms()->detach($permissionName);
        $role->save();
    }
}
