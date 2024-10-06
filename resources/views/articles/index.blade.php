@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
<div class="row">
    <div class="col-sm">
        <a href="{{ route('articles.create') }}" class="btn btn-success">Thêm mới bài viết</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Mã loại</th>
                    <th scope="col">Tên bài hát</th>
                    <th scope="col">Tóm tắt</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Ngày viết</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->tieude }}</td>
                    <td>{{ $article->ma_tloai }}</td>
                    <td>{{ $article->ten_bhat }}</td>
                    <td>{{ $article->tomtat }}</td>
                    <td>{{ $article->noidung }}</td>
                    <td>{{ $article->ngayviet }}</td>
                    <td><img src="{{ $article->hinhanh }}" alt="Hình ảnh bài viết" style="max-width: 100px; max-height: 100px;"></td>

                    <!-- Cập nhật bài viết -->
                    <td><a href="{{ route('articles.edit', $article->id) }}"><i class='fa-solid fa-pen-to-square'></i></a></td>
                    <!-- Xóa bài viết -->
                    <td>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">
                                <i class='fa-solid fa-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection