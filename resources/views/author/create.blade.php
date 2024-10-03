@extends('layouts.app')
@section('content')
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới tác giả</h3>

                <form action="{{ route('authors.store')}}" method="POST">
                    @csrf

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên tác giả</span>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="form-group float-end">
                        <input href="" name="btnAdd" type="submit" value="Thêm" class="btn btn-success">
                        <a href="{{ route('authors.index') }}" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection