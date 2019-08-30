<?php

namespace App\Observers;

use App\Helper\Util;
use App\Models\Menu;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;

class ModuleObserver
{
    protected $data;

    /**
     * @param Module $module
     */
    public function updated(Module $module)
    {
        if ($module->getOriginal('status') != $module->status && $module->status == 1) {
            $util = new Util();
            //$pieces = preg_split('/(?=[A-Z])/', $module->name);
            $permissions = ['index', 'create', 'show', 'edit', 'destroy'];
            foreach ($permissions as $key => $permission) {
                $this->data['name'] = str_plural($module->slug) . '.' . $permission;
                $this->data['module_id'] = $module->id;
                $this->data['display_name'] = ucwords(str_replace("-", " ", $module->slug));
                $this->data['description'] = ucwords($permission) . ' ' . ucwords(str_replace("-", " ", $module->slug));
                $this->data['is_protected'] = 0;
                /*$this->data['name'] = str_plural(lcfirst($module->name)) . '.' . $permission;
                $this->data['display_name'] = substr(join(" ", $pieces), 1);
                $this->data['description'] = ucwords($permission) . ' ' . $module->slug;*/
                $ids[] = Permission::insertGetId($this->data);
                #update csv
                $util->updateCSV('permissions_seeder.csv', [$this->data]);
            }
            $super_admin = Role::find(Role::ROLE_SUPER_ADMIN);
            $super_admin->perms()->attach($ids);

            #update csv
            foreach ($ids as $id) {
                $permissionRoleData[] = [
                    'permission_id' => $id,
                    'role_id'       => Role::ROLE_SUPER_ADMIN
                ];
            }

            $util->updateCSV('permission_role_seeder.csv', $permissionRoleData);

            $max_position = Menu::all()->max('position');
            $newMenu = [
                'name'         => ucwords(str_replace("-", " ", $module->slug)),
                'module_id'    => $module->id,
                'icon'         => $module->icon,
                'slug'         => str_plural($module->slug),
                'position'     => $max_position + 1,
                'is_protected' => 0,
                'static'       => 0,
                'status'       => 1,
            ];

            Menu::create($newMenu);
            #update csv
            $util->updateCSV('menus_seeder.csv', [$newMenu]);
            /*Menu::create([
                'name'     => str_plural(substr(join(" ", $pieces), 1)),
                'slug'     => str_plural(lcfirst($module->name)),
                'position' => $max_position + 1,
                'icon'     => $module->icon
            ]);*/
        }
    }
}