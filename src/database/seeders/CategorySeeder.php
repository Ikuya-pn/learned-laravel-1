<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('primary_categories')->insert([
            [
                'name' => '食品・飲料',
                'sort_order' => 1,
            ],      
            [
                'name' => 'ファッション',
                'sort_order' => 2,
            ],      
            [
                'name' => 'ドラッグストア',
                'sort_order' => 3,
            ],      
        ]);

        DB::table('secondary_categories')->insert([
            [
                'primary_category_id' => 1,
                'name' => 'お菓子',
                'sort_order' => 1,
            ],
            [
                'primary_category_id' => 1,
                'name' => '米',
                'sort_order' => 2,
            ],
            [
                'primary_category_id' => 2,
                'name' => 'トップス',
                'sort_order' => 3,
            ],
            [
                'primary_category_id' => 2,
                'name' => 'シューズ',
                'sort_order' => 4,
            ],
            [
                'primary_category_id' => 3,
                'name' => '日用品',
                'sort_order' => 5,
            ],
        ]);
    }
}
