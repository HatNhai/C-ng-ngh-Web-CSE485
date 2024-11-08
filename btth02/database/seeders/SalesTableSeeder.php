<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 100; $i++){
        DB::table('sales')->insert([
      	'medicine_id' => $faker->randomNumber(1, 100) ,
        'quantity' => $faker->randomNumber() ,
        'sale_date' => $faker->date() ,
        'customer_phone' => $faker->numerify('##########'),
        'created_at' => now(),
        'updated_at' => now(),
           ]);
       }
    }
}
