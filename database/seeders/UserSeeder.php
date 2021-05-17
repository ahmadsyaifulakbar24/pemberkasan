<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Directure',
            'username' => 'dir_osp',
            'password' => Hash::make('monitoringospkwa'),
            'role_id' => 200,
        ]);

        DB::table('users')->insert([
            'name' => 'Rizky Nursandi',
            'username' => 'mgr_osp',
            'password' => Hash::make('ospkwa21'),
            'role_id' => 201,
        ]);

        DB::table('users')->insert([
            'name' => 'ipung',
            'username' => 'leader_osp1',
            'password' => Hash::make('ptkwa123'),
            'role_id' => 202,
        ]);

        DB::table('users')->insert([
            'name' => 'bambang',
            'username' => 'leader_osp2',
            'password' => Hash::make('semangat45osp'),
            'role_id' => 202,
        ]);
    }
}
