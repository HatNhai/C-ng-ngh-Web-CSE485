<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 100; $i++){
        DB::table('computers')->insert([
      	'computer_name' =>'Lab'. $faker->randomNumber(1, 100) ,
        'model' => $faker->randomElement(['Dell', 'Hp', 'Assus']) ,
        'operating_system' => $faker->randomElement(['Win 10', 'Win11']) ,
        'processor' => $faker->randomElement(['Intel core i3', 'Intel core i5']),
        'memory' => $faker->randomElement([32, 64, 120]),
        'available' => $faker->boolean(),
        'created_at' => now(),
        'updated_at' => now(),
           ]);
       }
    }
}
