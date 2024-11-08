<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MedicinesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index){
            DB::table('medicines')->insert([
                'name' => $faker->name(),
                'brand' => $faker->company(),
                'dosage' => $faker->randomElement(['5mg', '10mg', '15mg']),
                'form' => $faker->randomElement(['Vien nang', 'Vien nen', 'Xi-ro']),
                'price' => $faker->randomFloat(1, 100, 1000),
                'stock' => $faker->randomNumber(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}