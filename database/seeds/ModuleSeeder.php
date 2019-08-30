<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ModuleSeeder
 */
class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $util = new \App\Helper\Util();
        $seedingData = $util->seedWithCSV('modules_seeder.csv');
        DB::table('modules')->insert($seedingData);
        /*DB::table('modules')->insert([
            [
                'name'         => "Admin Panel",
                'slug'         => "adminpanel",
                'table_name'   => "-",
                'icon'         => "fa fa-dashboard",
                'is_module'    => 0,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "Dashboard",
                'slug'         => "dashboard",
                'table_name'   => "-",
                'icon'         => "fa fa-dashboard",
                'is_module'    => 0,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "Users",
                'slug'         => "users",
                'table_name'   => "users",
                'icon'         => "fa fa-user",
                'is_module'    => 1,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "Roles",
                'slug'         => "roles",
                'table_name'   => "roles",
                'icon'         => "fa fa-edit",
                'is_module'    => 1,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "Permissions",
                'slug'         => "permissions",
                'table_name'   => "permissions",
                'icon'         => "fa fa-check-square-o",
                'is_module'    => 1,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "Modules",
                'slug'         => "modules",
                'table_name'   => "modules",
                'icon'         => "fa fa-database",
                'is_module'    => 1,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "Languages",
                'slug'         => "languages",
                'table_name'   => "locales",
                'icon'         => "fa fa-comments-o",
                'is_module'    => 1,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "Page",
                'slug'         => "pages",
                'table_name'   => "pages",
                'icon'         => "fa fa-wpforms",
                'is_module'    => 1,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "ContactUs",
                'slug'         => "contactus",
                'table_name'   => "admin_queries",
                'icon'         => "fa fa-mail-forward",
                'is_module'    => 1,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "Notification",
                'slug'         => "notifications",
                'table_name'   => "notifications",
                'icon'         => "fa fa-bell",
                'is_module'    => 1,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ],
            [
                'name'         => "Menu",
                'slug'         => "menus",
                'table_name'   => "menus",
                'icon'         => "fa fa-th",
                'is_module'    => 1,
                'status'       => 1,
                'config'       => null,
                'is_protected' => 1
            ]
        ]);*/
    }
}
