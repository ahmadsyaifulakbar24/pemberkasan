<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('params')->insert([
            'id' => 1,
            'parent_id' => NULL,
            'category_param' => 'status_project',
            'param' => 'survey',
            'order' => 1,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 2,
            'parent_id' => NULL,
            'category_param' => 'status_project',
            'param' => 'Pekerjaan Fisik',
            'order' => 2,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 3,
            'parent_id' => NULL,
            'category_param' => 'status_project',
            'param' => 'Terminasi',
            'order' => 3,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 4,
            'parent_id' => NULL,
            'category_param' => 'status_project',
            'param' => 'Jumper/ Labeling/ Valins',
            'order' => 4,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 5,
            'parent_id' => NULL,
            'category_param' => 'status_project',
            'param' => 'Valid 4',
            'order' => 5,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 6,
            'parent_id' => NULL,
            'category_param' => 'status_project',
            'param' => 'Golive',
            'order' => 6,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 7,
            'parent_id' => NULL,
            'category_param' => 'status_project',
            'param' => 'Omzetting',
            'order' => 7,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 8,
            'parent_id' => NULL,
            'category_param' => 'gamas_status',
            'param' => 'Open',
            'order' => 1,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 9,
            'parent_id' => NULL,
            'category_param' => 'gamas_status',
            'param' => 'Close',
            'order' => 2,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 10,
            'parent_id' => NULL,
            'category_param' => 'type_project',
            'param' => 'QE',
            'order' => 1,
            'active' => true,
        ]);
        
        DB::table('params')->insert([
            'id' => 11,
            'parent_id' => NULL,
            'category_param' => 'type_project',
            'param' => 'Gamas',
            'order' => 2,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 12,
            'parent_id' => NULL,
            'category_param' => 'type_project',
            'param' => 'PT2 Plus',
            'order' => 3,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 13,
            'parent_id' => NULL,
            'category_param' => 'type_project',
            'param' => 'PT3',
            'order' => 4,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 14,
            'parent_id' => NULL,
            'category_param' => 'type_project',
            'param' => 'PPJAB',
            'order' => 5,
            'active' => true,
        ]);

        DB::table('params')->insert([
            'id' => 15,
            'parent_id' => NULL,
            'category_param' => 'status_project',
            'param' => 'selesai',
            'order' => 8,
            'active' => true,
        ]);
    }
}
