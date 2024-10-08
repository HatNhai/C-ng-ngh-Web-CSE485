<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class theses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $faker = Faker::create();
        $ma_sv = DB::table('students')->pluck('id')->toArray();
        
        for($i = 0; $i < 10; $i++){
            DB::table('theses')->insert([
                'title' => $faker->name(),
                'student_id' =>$faker->randomElement($ma_sv),
                'program' => $faker->text(),
                'supervisor' => $faker->name(),
                'abstract' => $faker->text(),
                'submission_date' => $faker->date(),
                'defense_date' => $faker->date(),
            ]);
        }
    }
}
