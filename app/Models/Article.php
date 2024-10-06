<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'tieude',
        'ten_bhat',
        'tomtat',
        'noidung',
        'ngayviet',
        'hinhanh',
        'ma_tgia',
        'ma_tloai',
        // Thêm các thuộc tính khác nếu cần
    ];
}
