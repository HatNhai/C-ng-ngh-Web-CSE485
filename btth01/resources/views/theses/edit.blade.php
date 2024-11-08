<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <title>Posts</title>
</head>

<body>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h1 class="text-center text-uppercase fw-bold mb-4">Cập nhật thông tin đồ án</h1>

                <form action="{{ route('theses.update', $thesis->id) }}" method="POST" ">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-4">
                        <label for="title" class="form-label">Tên đồ án</label>
                        <input type="text" name="title" class="form-control" value="{{ $thesis->title }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="student_id" class="form-label">Sinh viên</label>
                        <select name="student_id" class="form-control" required>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $student->id == $thesis->student_id ? 'selected' : '' }}>
                                {{ $student->first_name }} {{ $student->last_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="program" class="form-label">Chương trình học</label>
                        <input type="text" name="program" class="form-control" value="{{ $thesis->program }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="supervisor" class="form-label">GV hướng dẫn</label>
                        <input type="text" name="supervisor" class="form-control" value="{{ $thesis->supervisor }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="submission_date" class="form-label">Ngày nộp</label>
                        <input type="date" name="submission_date" class="form-control" value="{{ $thesis->submission_date }}">
                    </div>

                    <div class="form-group mb-4">
                        <label for="defense_date" class="form-label">Ngày bảo vệ</label>
                        <input type="date" name="defense_date" class="form-control" value="{{ $thesis->defense_date }}">
                    </div>

                    <div class="form-group float-end" style="padding: 30px;">
                        <input type="submit" value="Sửa" class="btn btn-success me-2">
                        <a href="{{ route('theses.index') }}" class="btn btn-warning">Quay lại</a>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>

</html>
