<!DOCTYPE html>
<html>

<head>
    <title>Course List</title>
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
            <h1>Course List</h1>
            <a href="{{ route('gotoAddCoursePage') }}" class="btn btn-primary">Add Course</a>
        </div>

        <!-- Success Message -->
        <div>
            @if(session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
            @endif
        </div>

        <!-- Course List Table -->
        <div class="table-container">
            <table class="table table-bordered table-striped table-hover text-center" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Level</th>
                        <th>Semester</th>
                        <th>Credit</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->code }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->level }}</td>
                        <td>{{ $course->semester }}</td>
                        <td>{{ $course->credit_hour }}</td>
                        <td>{{ $course->type }}</td>
                        <td>
                            <form method="post" action="{{ route('course.destroy', ['course' => $course]) }}" onsubmit="return confirm('Are you sure you want to delete this course?');">
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