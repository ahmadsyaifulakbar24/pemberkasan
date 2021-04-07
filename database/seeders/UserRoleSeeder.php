<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'id' => 1,
            'name' => 'super_admin'
        ]);

        DB::table('user_roles')->insert([
            'id' => 100,
            'name' => 'admin'
        ]);

        DB::table('user_roles')->insert([
            'id' => 200,
            'name' => 'directur'
        ]);

        DB::table('user_roles')->insert([
            'id' => 201,
            'name' => 'manager'
        ]);

        DB::table('user_roles')->insert([
            'id' => 202,
            'name' => 'leader_tim',
        ]);
    }
}
