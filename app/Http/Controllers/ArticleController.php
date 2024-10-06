<?php

namespace App\Http\Controllers;

use App\Models\Article; // Đảm bảo đã sử dụng model
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Phương thức hiển thị danh sách bài viết
    public function index()
    {
        $articles = Article::all(); // Lấy tất cả các bài viết từ cơ sở dữ liệu
        return view('articles.index', compact('articles')); // Trả về view với danh sách bài viết
    }

    // Phương thức hiển thị form thêm mới bài viết
    public function create()
    {
        return view('articles.create'); // Trả về view tạo bài viết
    }

    // Phương thức lưu bài viết mới
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tieude' => 'required|string|max:255',
            'ten_bhat' => 'required|string|max:255',
            'tomtat' => 'nullable|string',
            'noidung' => 'required|string',
            'ngayviet' => 'required|date',
            'hinhanh' => 'nullable|url',
            'ma_tloai' => 'required|integer', // Đảm bảo ma_tloai là trường bắt buộc
            // Thêm các thuộc tính khác nếu có
        ]);

        // Tạo mới bài viết với tất cả các thuộc tính
        Article::create([ // Đây là nơi gọi phương thức create của mô hình Article
            'tieude' => $request->tieude,
            'ten_bhat' => $request->ten_bhat,
            'tomtat' => $request->tomtat,
            'noidung' => $request->noidung,
            'ngayviet' => $request->ngayviet,
            'hinhanh' => $request->hinhanh,
            'ma_tloai' => $request->ma_tloai,
            'ma_tgia' => $request->ma_tgia,
            // Thêm các thuộc tính khác vào đây
        ]);

        return redirect()->route('articles.index')->with('success', 'Bài viết đã được thêm!');
    }

    // Phương thức hiển thị form sửa bài viết
    public function edit($id)
    {
        $article = Article::findOrFail($id); // Lấy bài viết theo ID
        return view('articles.edit', compact('article')); // Trả về view sửa bài viết
    }

    // Phương thức cập nhật bài viết
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id); // Lấy bài viết theo ID

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tieude' => 'required|string|max:255',
            'ten_bhat' => 'required|string|max:255',
            'tomtat' => 'nullable|string',
            'noidung' => 'required|string',
            'ngayviet' => 'required|date',
            'hinhanh' => 'nullable|url',
            'ma_tloai' => 'required|integer',
            'ma_tgia' => 'required|integer'
            // Thêm các thuộc tính khác nếu có
        ]);

        // Cập nhật bài viết với tất cả các thuộc tính
        $article->update([ // Đây là nơi gọi phương thức update của mô hình Article
            'tieude' => $request->tieude,
            'ten_bhat' => $request->ten_bhat,
            'tomtat' => $request->tomtat,
            'noidung' => $request->noidung,
            'ngayviet' => $request->ngayviet,
            'hinhanh' => $request->hinhanh,
            'ma_tloai' => $request->ma_tloai,
            'ma_tgia' => $request->ma_tgia,
            // Thêm các thuộc tính khác vào đây
        ]);

        return redirect()->route('articles.index')->with('success', 'Bài viết đã được cập nhật!');
    }

    // Phương thức xóa bài viết
    public function destroy($id)
    {
        $article = Article::findOrFail($id); // Lấy bài viết theo ID
        $article->delete(); // Xóa bài viết

        return redirect()->route('articles.index')->with('success', 'Bài viết đã được xóa!');
    }
}
