<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionSeeder
 */
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $util = new \App\Helper\Util();
        $seedingData = $util->seedWithCSV('permissions_seeder.csv');
        DB::table('permissions')->insert($seedingData);
        /*DB::table('permissions')->insert([
            [
                'name'         => "adminpanel",
                'display_name' => "Admin Panel",
                'description'  => "Admin Panel",
                'is_protected' => 1
            ],
            [
                'name'         => "dashboard",
                'display_name' => "Dashboard",
                'description'  => "Dashboard",
                'is_protected' => 1
            ],
            [
                'name'         => "permissions.index",
                'display_name' => "List Permissions",
                'description'  => "List Permissions",
                'is_protected' => 1
            ],
            [
                'name'         => "permissions.create",
                'display_name' => "Create Permission",
                'description'  => "Create Permission",
                'is_protected' => 1
            ],
            [
                'name'         => "permissions.show",
                'display_name' => "View Permission",
                'description'  => "View Permission",
                'is_protected' => 1
            ],
            [
                'name'         => "permissions.edit",
                'display_name' => "Edit Permission",
                'description'  => "Edit Permission",
                'is_protected' => 1
            ],
            [
                'name'         => "permissions.destroy",
                'display_name' => "Delete Permission",
                'description'  => "Delete Permission",
                'is_protected' => 1
            ],
            [
                'name'         => "roles.index",
                'display_name' => "List Roles",
                'description'  => "List Roles",
                'is_protected' => 1
            ],
            [
                'name'         => "roles.create",
                'display_name' => "Create Role",
                'description'  => "Create Role",
                'is_protected' => 1
            ],
            [
                'name'         => "roles.show",
                'display_name' => "View Role",
                'description'  => "View Role",
                'is_protected' => 1
            ],
            [
                'name'         => "roles.edit",
                'display_name' => "Edit Role",
                'description'  => "Edit Role",
                'is_protected' => 1
            ],
            [
                'name'         => "roles.destroy",
                'display_name' => "Delete Role",
                'description'  => "Delete Role",
                'is_protected' => 1
            ],
            [
                'name'         => "users.index",
                'display_name' => "List Roles",
                'description'  => "List Roles",
                'is_protected' => 1
            ],
            [
                'name'         => "users.create",
                'display_name' => "Create Users",
                'description'  => "Create Users",
                'is_protected' => 1
            ],
            [
                'name'         => "users.show",
                'display_name' => "View User",
                'description'  => "View User",
                'is_protected' => 1
            ],
            [
                'name'         => "users.edit",
                'display_name' => "Edit User",
                'description'  => "Edit User",
                'is_protected' => 1
            ],
            [
                'name'         => "users.destroy",
                'display_name' => "Delete User",
                'description'  => "Delete User",
                'is_protected' => 1
            ],
            [
                'name'         => "modules.index",
                'display_name' => "List Modules",
                'description'  => "List Modules",
                'is_protected' => 1
            ],
            [
                'name'         => "modules.create",
                'display_name' => "Create Module",
                'description'  => "Create Module",
                'is_protected' => 1
            ],
            [
                'name'         => "modules.show",
                'display_name' => "View Module",
                'description'  => "View Module",
                'is_protected' => 1
            ],
            [
                'name'         => "modules.edit",
                'display_name' => "Edit Module",
                'description'  => "Edit Module",
                'is_protected' => 1
            ],
            [
                'name'         => "modules.destroy",
                'display_name' => "Delete Module",
                'description'  => "Delete Module",
                'is_protected' => 1
            ],
            [
                'name'         => "languages.index",
                'display_name' => "List Languages",
                'description'  => "List Languages",
                'is_protected' => 1
            ],
            [
                'name'         => "languages.create",
                'display_name' => "Create Languages",
                'description'  => "Create Languages",
                'is_protected' => 1
            ],
            [
                'name'         => "languages.show",
                'display_name' => "View Languages",
                'description'  => "View Languages",
                'is_protected' => 1
            ],
            [
                'name'         => "languages.edit",
                'display_name' => "Edit Languages",
                'description'  => "Edit Languages",
                'is_protected' => 1
            ],
            [
                'name'         => "languages.destroy",
                'display_name' => "Delete Languages",
                'description'  => "Delete Languages",
                'is_protected' => 1
            ],
            [
                'name'         => "pages.index",
                'display_name' => "List Pages",
                'description'  => "List Pages",
                'is_protected' => 1
            ],
            [
                'name'         => "pages.create",
                'display_name' => "Create Pages",
                'description'  => "Create Pages",
                'is_protected' => 1
            ],
            [
                'name'         => "pages.show",
                'display_name' => "View Pages",
                'description'  => "View Pages",
                'is_protected' => 1
            ],
            [
                'name'         => "pages.edit",
                'display_name' => "Edit Pages",
                'description'  => "Edit Pages",
                'is_protected' => 1
            ],
            [
                'name'         => "pages.destroy",
                'display_name' => "Delete Pages",
                'description'  => "Delete Pages",
                'is_protected' => 1
            ],
            [
                'name'         => "contactus.index",
                'display_name' => "List Contact Us",
                'description'  => "List Contact Us Record",
                'is_protected' => 1
            ],
            [
                'name'         => "contactus.create",
                'display_name' => "Create Contact Us",
                'description'  => "Create Contact Us Record",
                'is_protected' => 1
            ],
            [
                'name'         => "contactus.show",
                'display_name' => "View Contact Us",
                'description'  => "View Contact Us Record",
                'is_protected' => 1
            ],
            [
                'name'         => "contactus.edit",
                'display_name' => "Edit Contact Us",
                'description'  => "Edit Contact Us Record",
                'is_protected' => 1
            ],
            [
                'name'         => "contactus.destroy",
                'display_name' => "Delete Contact Us",
                'description'  => "Delete Contact Us Record",
                'is_protected' => 1
            ],
            [
                'name'         => "notifications.index",
                'display_name' => "List Notification",
                'description'  => "List Notification",
                'is_protected' => 1
            ],
            [
                'name'         => "notifications.create",
                'display_name' => "Create Notification",
                'description'  => "Create Notification",
                'is_protected' => 1
            ],
            [
                'name'         => "notifications.show",
                'display_name' => "View Notification",
                'description'  => "View Notification",
                'is_protected' => 1
            ],
            [
                'name'         => "notifications.edit",
                'display_name' => "Edit Notification",
                'description'  => "Edit Notification",
                'is_protected' => 1
            ],
            [
                'name'         => "notifications.destroy",
                'display_name' => "Delete Notification",
                'description'  => "Delete Notification",
                'is_protected' => 1
            ],
            [
                'name'         => "menus.index",
                'display_name' => "List Menu",
                'description'  => "List Menu",
                'is_protected' => 1
            ],
            [
                'name'         => "menus.create",
                'display_name' => "Create Menu",
                'description'  => "Create Menu",
                'is_protected' => 1
            ],
            [
                'name'         => "menus.show",
                'display_name' => "View Menu",
                'description'  => "View Menu",
                'is_protected' => 1
            ],
            [
                'name'         => "menus.edit",
                'display_name' => "Edit Menu",
                'description'  => "Edit Menu",
                'is_protected' => 1
            ],
            [
                'name'         => "menus.destroy",
                'display_name' => "Delete Menu",
                'description'  => "Delete Menu",
                'is_protected' => 1
            ]
        ]);*/
    }
}