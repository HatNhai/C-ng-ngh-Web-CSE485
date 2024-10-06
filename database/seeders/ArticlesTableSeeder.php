<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        // Xóa dữ liệu cũ trong bảng articles
        DB::table('articles')->delete();

        // Tạo instance Faker
        $faker = Faker::create();

        // Tạo 50 bài viết giả
        for ($i = 0; $i < 50; $i++) {
            Article::create([
                'tieude' => $faker->sentence(6, true), // Tiêu đề ngẫu nhiên
                'ten_bhat' => $faker->sentence(3, true), // Tên bài hát ngẫu nhiên
                'ma_tloai' => rand(1, 10), // Giả sử có 10 loại
                'tomtat' => $faker->paragraph, // Tóm tắt ngẫu nhiên
                'noidung' => $faker->text(200), // Nội dung ngẫu nhiên
                'ma_tgia' => rand(1, 10), // Giả sử có 10 tác giả
                'ngayviet' => $faker->dateTimeThisYear, // Ngày viết ngẫu nhiên trong năm
                'hinhanh' => $faker->imageUrl(200, 200, 'cats'), // Hình ảnh ngẫu nhiên
            ]);
        }
    }
}
