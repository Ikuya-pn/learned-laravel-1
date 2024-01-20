<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => 'shop1',
                'information' => 'information1',
                'filename' => 'sample1.jpeg',
                'is_selling' => true,
            ],
            [
                'owner_id' => 2,
                'name' => 'shop2',
                'information' => 'information1',
                'filename' => 'sample2.jpeg',
                'is_selling' => true,
            ],[
                'owner_id' => 3,
                'name' => 'shop3',
                'information' => 'information1',
                'filename' => 'sample3.jpeg',
                'is_selling' => true,
            ],
            [
                'owner_id' => 4,
                'name' => 'shop4',
                'information' => 'information1',
                'filename' => 'sample4.jpeg',
                'is_selling' => true,
            ],
            [
                'owner_id' => 5,
                'name' => 'shop5',
                'information' => 'information1',
                'filename' => 'sample5.jpeg',
                'is_selling' => true,
            ],
            [
                'owner_id' => 6,
                'name' => 'shop6',
                'information' => 'information1',
                'filename' => 'sample6.jpg',
                'is_selling' => true,
            ],
        ]);
    }
}
