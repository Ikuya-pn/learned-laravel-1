<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('owners')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'test4',
                'email' => 'test4@test.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'test5',
                'email' => 'test5@test.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'test6',
                'email' => 'test6@test.com',
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
            ],
            
        ]);
    }
}
