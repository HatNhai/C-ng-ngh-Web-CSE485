@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm">
            <a href="{{ route('authors.create') }}" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên tác giả</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td> {{$author->id}} </td>
                            <td> {{$author->name}} </td>
                            <!-- Cap nhat tac gia -->
                            <td><a href="{{ route('authors.edit', $author->id) }}"><i class='fa-solid fa-pen-to-square'></i></a></td>
                            <!-- Xoa tac gia -->
                            <td>
                                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tác giả này không?')">
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