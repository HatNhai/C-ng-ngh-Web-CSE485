<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Cập nhật thông tin</title>
</head>

<body>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h1 class="text-center text-uppercase fw-bold">Cập nhật thông tin</h1>
                <form action="{{ route('students.update', $student->id) }}" method="POST" style="margin: 50px 50px">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $student->first_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $student->last_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $student->date_of_birth }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="parent_phone" class="form-label">Parent Phone</label>
                        <input type="text" class="form-control" id="parent_phone" name="parent_phone" value="{{ $student->parent_phone }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="classroom_id" class="form-label">Grade Level</label>
                        <select class="form-control" id="classroom_id" name="classroom_id" required>
                            @foreach($classrooms as $classroom)
                                <option value="{{ $classroom->id }}" {{ $classroom->id == $student->classroom_id ? 'selected' : '' }}>
                                    {{ $classroom->grade_level }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group float-end" style="padding: 30px;">
                        <input type="submit" value="Sửa" class="btn btn-success me-2">
                        <a href="{{ route('students.index') }}" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
