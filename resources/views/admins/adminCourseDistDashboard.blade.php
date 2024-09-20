<!DOCTYPE html>
<html>

<head>
    <title>Course Distribution List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h1>Course Distribution</h1>
            <a href="{{ route('gotoAdminCourseDist') }}" class="btn btn-primary">Distribute Course</a>
        </div>

        <!-- Success Message -->
        <div>
            @if(session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
            @endif
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('gotoAdminCourseDist') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="course_code" value="{{ request('course_code') }}" class="form-control" placeholder="Course Code">
                </div>
                <div class="col-md-3">
                    <input type="text" name="course_name" value="{{ request('course_name') }}" class="form-control" placeholder="Course Name">
                </div>
                <div class="col-md-3">
                    <input type="text" name="teacher_name" value="{{ request('teacher_name') }}" class="form-control" placeholder="Teacher">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('gotoAdminCourseDist') }}" class="btn btn-secondary">Clear</a>
                </div>
            </div>
        </form>

        <!-- Course Distribution Table -->
        <div class="table-container">
            <table class="table table-bordered table-striped table-hover text-center" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Teacher</th>
                        <th>Session</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cdistributions as $cdistribution)
                    <tr>
                        <td>{{ $cdistribution->course_code }}</td>
                        <td>{{ $cdistribution->name }}</td>
                        <td>{{ $cdistribution->teacher_name }}</td>
                        <td>{{ $cdistribution->session }}</td>
                        <td>
                            <form method="post" action="{{ route('coursedist.destroy', ['cdistribution' => $cdistribution->course_code]) }}" onsubmit="return confirm('Are you sure you want to delete this course distribution?');">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+FF4s0Qnb4F28LlGXKa6tXKp4RgQ" crossorigin="anonymous"></script>
</body>

</html>
