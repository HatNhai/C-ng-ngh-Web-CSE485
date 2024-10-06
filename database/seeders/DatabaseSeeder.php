<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo một người dùng mẫu
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Gọi các seeder khác
        $this->call([
            //    AuthorsTableSeeder::class, // Gọi seeder cho bảng authors
            //    BooksTableSeeder::class,   // Gọi seeder cho bảng books
            ArticlesTableSeeder::class, // Gọi seeder cho bảng articles
        ]);
    }
}
