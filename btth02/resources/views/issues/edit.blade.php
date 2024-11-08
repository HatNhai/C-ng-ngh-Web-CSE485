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
                <form action="{{ route('issues.update', $issue->id) }}" method="POST" style="margin: 50px 50px">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="computer_id" class="form-label">Tên máy tính</label>
                        <select class="form-control" id="computer_id" name="computer_id" required>
                            @foreach($computers as $computer)
                                <option value="{{ $computer->id }}" {{ $computer->id == $issue->computer_id ? 'selected' : '' }}>{{ $computer->computer_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="reported_by" class="form-label">Tên người báo cáo</label>
                        <input type="text" class="form-control" id="reported_by" name="reported_by" value="{{$issue->reported_by}}"  required>
                    </div>

                    <div class="mb-3">
                        <label for="reported_date" class="form-label">Ngày báo cáo</label>
                        <input type="date" class="form-control" id="reported_date" name="reported_date" value="{{$issue->reported_date}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{$issue->description}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="urgency" class="form-label">Mức độ báo cáo</label>
                        <select class="form-control" name="urgency" id="urgency">
                            <option value="Low" {{$issue->urgency == 'Low' ? 'selected' : ''}}>Low</option>
                            <option value="Medium" {{$issue->urgency == 'Medium' ? 'selected' : ''}}>Medium</option>
                            <option value="High" {{$issue->urgency == 'High' ? 'selected' : ''}}>High</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Open" {{$issue->status == 'Open' ? 'selected' : ''}}>Open</option>
                            <option value="In Progress" {{$issue->status == 'In Progress' ? 'selected' : ''}}>In Progress</option>
                            <option value="Resolved" {{$issue->status == 'Resolved' ? 'selected' : ''}}>Resolved</option>
                        </select>
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" value="Cập nhật" class="btn btn-success">
                        <a href="{{ route('issues.index') }}" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
