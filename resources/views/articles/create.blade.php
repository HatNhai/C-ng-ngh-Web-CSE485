@extends('layouts.app')

@section('title', 'Thêm mới bài viết')

@section('content')
<div class="row">
    <div class="col-sm">
        <h3 class="text-center text-uppercase fw-bold">Thêm mới bài viết</h3>

        <form action="{{ route('articles.store') }}" method="POST">
            @csrf

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Tiêu đề</span>
                <input type="text" class="form-control" name="tieude" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Tên bài hát</span>
                <input type="text" class="form-control" name="ten_bhat" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Tóm tắt</span>
                <textarea class="form-control" name="tomtat" required></textarea>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Nội dung</span>
                <textarea class="form-control" name="noidung" required></textarea>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Ngày viết</span>
                <input type="date" class="form-control" name="ngayviet" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Hình ảnh URL</span>
                <input type="text" class="form-control" name="hinhanh" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Mã loại</span>
                <input type="number" class="form-control" name="ma_tloai" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Mã tác giả</span>
                <input type="number" class="form-control" name="ma_tgia" required>
            </div>

            <div class="form-group float-end">
                <input type="submit" value="Thêm mới" class="btn btn-success">
                <a href="{{ route('articles.index') }}" class="btn btn-warning">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection