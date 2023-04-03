<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $category = [
            ['name' => "মৎস্য"],
            ['name' => "পশুসম্পত্তি"],
            ['name' => "কৃষি"],
            ['name' => "রোগ নির্ণয়"],
        ];

        foreach ($category as $cat) {
            DB::table('categories')->insert([[
                'name' => $cat['name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]]);
        }
    }
}
