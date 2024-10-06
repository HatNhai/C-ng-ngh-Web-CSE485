<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->delete();
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            Category::create([
                'name' => $faker->name,
            ]);
        }
    }
}
