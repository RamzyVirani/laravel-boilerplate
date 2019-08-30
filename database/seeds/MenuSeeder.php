<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class MenuSeeder
 */
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $util = new \App\Helper\Util();
        $seedingData = $util->seedWithCSV('menus_seeder.csv');
        DB::table('menus')->insert($seedingData);
//        DB::table('menus')->insert([
//            [
//                'name'         => "Dashboard",
//                'icon'         => "fa fa-dashboard",
//                'slug'         => "dashboard",
//                'position'     => 1,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ],
//            [
//                'name'         => "Users",
//                'icon'         => "fa fa-user",
//                'slug'         => "users",
//                'position'     => 2,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ],
//            [
//                'name'         => "Roles",
//                'icon'         => "fa fa-edit",
//                'slug'         => "roles",
//                'position'     => 3,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ],
//            [
//                'name'         => "Permissions",
//                'icon'         => "fa fa-check-square-o",
//                'slug'         => "permissions",
//                'position'     => 4,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ],
//            [
//                'name'         => "Modules",
//                'icon'         => "fa fa-database",
//                'slug'         => "modules",
//                'position'     => 5,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ],
//            [
//                'name'         => "Languages",
//                'icon'         => "fa fa-comments-o",
//                'slug'         => "languages",
//                'position'     => 6,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ],
//            [
//                'name'         => "Pages",
//                'icon'         => "fa fa-wpforms",
//                'slug'         => "pages",
//                'position'     => 7,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ],
//            [
//                'name'         => "Menus",
//                'icon'         => "fa fa-th",
//                'slug'         => "menus",
//                'position'     => 8,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ],
//            [
//                'name'         => "Contact us",
//                'icon'         => "fa fa-mail-forward",
//                'slug'         => "contactus",
//                'position'     => 9,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ],
//            [
//                'name'         => "Notifications",
//                'icon'         => "fa fa-bell",
//                'slug'         => "notifications",
//                'position'     => 10,
//                'is_protected' => 1,
//                'static'       => 0,
//                'status'       => 1
//            ]
//        ]);
    }
}
