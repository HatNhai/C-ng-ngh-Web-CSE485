<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <title>Thêm mới</title>
</head>

<body>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h1 class="text-center text-uppercase fw-bold">Thêm mới</h1>
                <form action="{{route('sales.store') }}" method="POST" style="margin: 50px 50px">
                    @csrf

                    <div class="mb-3">
                        <label for="medicine_id" class="form-label">Tên thuốc</label>
                        <select class="form-control" id="medicine_id" name="medicine_id" required>
                            @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng bán</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="sale_date" class="form-label">Ngày bán</label>
                        <input type="date" class="form-control" id="sale_date" name="sale_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">Số điện thoại người mua</label>
                        <textarea class="form-control" id="customer_phone" name="customer_phone" rows="1" required></textarea>
                    </div>
                    
                    <div class="form-group  float-end">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="{{ route('sales.index') }}" class="btn btn-warning ">Quay lại</a>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>