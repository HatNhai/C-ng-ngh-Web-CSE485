<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class students extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 10; $i++){
            DB::table('students')->insert([
                'first_name' => $faker->name(),
                'last_name' => $faker->name(),
                'email' => $faker->email(),
                'student_number' => $faker->numerify('##########'),
            ]);
        }
    }
}
