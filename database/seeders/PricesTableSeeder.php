<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Define the values for year and category_id
        $years = [2016, 2017, 2018, 2019, 2020];
        $categoryIds = range(1, 5);

        // Specify the number of records to insert
        $numberOfRecords = 80000; // Adjust this number as needed

        // Prepare data and insert into the table
        $data = [];
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $data[] = [
                'year' => $years[array_rand($years)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'unit_price' => $faker->randomFloat(2, 10, 1000), // Random unit price between 10 and 1000
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data in chunks to avoid memory issues
        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
            DB::table('prices')->insert($chunk);
        }
    }
}
