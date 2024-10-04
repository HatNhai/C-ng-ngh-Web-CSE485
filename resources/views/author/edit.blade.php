@extends('/layouts.app') 
@section('content')
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin tác giả</h3>

                <form action="{{ route('authors.update', $author->id) }}" method="post">
                    @csrf 
                    @method('PUT') 
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Mã tác giả</span>
                        <input type="text" name="id" class="form-control" value="{{$author->id}}" readonly> <!-- Hiển thị ID -->
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Tên tác giả</span>
                        <input type="text" name="name" class="form-control" value="{{$author->name}}" required> <!-- Hiển thị tên tác giả -->
                    </div>

                    <div class="form-group float-end">
                        <input name="save" type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="{{ route('authors.index') }}" class="btn btn-warning">Quay lại</a>
                    </div>
                </form> 
            </div>
        </div>
    </main>
@endsection