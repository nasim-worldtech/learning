<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $sports = [
            'Cricket',
            'Football',
            'Basketball',
            'Tennis',
            'Hockey'
        ];

        foreach ($sports as $sport) {
            DB::table('categories')->insert([
                'name' => $sport,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
