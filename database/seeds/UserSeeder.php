<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'     => "Super Admin",
                'email'    => "superadmin@boilerplate.com",
                'password' => bcrypt('superadmin123')
            ],
            [
                'name'     => "Admin",
                'email'    => "admin@boilerplate.com",
                'password' => bcrypt('admin123')
            ]
        ]);

        DB::table('user_details')->insert([
            [
                'user_id'       => 1,
                'first_name'    => "Super",
                'last_name'     => "Admin",
                'phone'         => null,
                'address'       => null,
                'image'         => null,
                'is_verified'   => 1,
                'email_updates' => 1
            ],
            [
                'user_id'       => 2,
                'first_name'    => "Admin",
                'last_name'     => "User",
                'phone'         => null,
                'address'       => null,
                'image'         => null,
                'is_verified'   => 1,
                'email_updates' => 1
            ]
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 1,
                'role_id' => 1,
            ],
            [
                'user_id' => 2,
                'role_id' => 2,
            ],
            [
                'user_id' => 2,
                'role_id' => 3,
            ]
        ]);
    }
}