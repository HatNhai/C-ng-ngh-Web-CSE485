@extends('layouts.app')

@section('content')
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>

            <form action="{{ route('articles.update', $article->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">Mã bài viết</span>
                    <input type="text" name="id" class="form-control" value="{{ $article->id }}" readonly> <!-- Hiển thị ID -->
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">Tiêu đề</span>
                    <input type="text" name="tieude" class="form-control" value="{{ $article->tieude }}" required> <!-- Hiển thị tiêu đề -->
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">Tên bài hát</span>
                    <input type="text" name="ten_bhat" class="form-control" value="{{ $article->ten_bhat }}" required> <!-- Hiển thị tên bài hát -->
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">Tóm tắt</span>
                    <textarea class="form-control" name="tomtat" required>{{ $article->tomtat }}</textarea> <!-- Hiển thị tóm tắt -->
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">Nội dung</span>
                    <textarea class="form-control" name="noidung" required>{{ $article->noidung }}</textarea> <!-- Hiển thị nội dung -->
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">Ngày viết</span>
                    <input type="date" name="ngayviet" class="form-control" value="{{ \Carbon\Carbon::parse($article->ngayviet)->format('Y-m-d') }}" required><!-- Hiển thị ngày viết -->
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">Hình ảnh URL</span>
                    <input type="text" name="hinhanh" class="form-control" value="{{ $article->hinhanh }}" required> <!-- Hiển thị hình ảnh -->
                </div>

                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">Mã loại</span>
                    <input type="number" name="ma_tloai" class="form-control" value="{{ $article->ma_tloai }}" required> <!-- Hiển thị mã loại -->
                </div>

                <div class="form-group float-end">
                    <input name="save" type="submit" value="Lưu lại" class="btn btn-success">
                    <a href="{{ route('articles.index') }}" class="btn btn-warning">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection