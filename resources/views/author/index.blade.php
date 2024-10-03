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
                            <td><a href=""><i class='fa-solid fa-pen-to-square'></i></a></td>
                            <td><a href=""><i class='fa-solid fa-trash'></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection