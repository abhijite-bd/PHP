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

        <!-- Filter Form -->
        <form method="GET" action="{{ route('gotoAdminCourse') }}" class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <select name="level" class="form-select">
                        <option value="">Select Level</option>
                        <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>Level 1</option>
                        <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>Level 2</option>
                        <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>Level 3</option>
                        <option value="4" {{ request('level') == '4' ? 'selected' : '' }}>Level 4</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="semester" class="form-select">
                        <option value="">Select Semester</option>
                        <option value="i" {{ request('semester') == 'i' ? 'selected' : '' }}>Semester I</option>
                        <option value="ii" {{ request('semester') == 'ii' ? 'selected' : '' }}>Semester II</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="credit_hour" class="form-select">
                        <option value="">Select Credit</option>
                        <option value="0.75" {{ request('credit_hour') == '0.75' ? 'selected' : '' }}>0.75</option>
                        <option value="1" {{ request('credit_hour') == '1' ? 'selected' : '' }}>1</option>
                        <option value="1.5" {{ request('credit_hour') == '1.5' ? 'selected' : '' }}>1.5</option>
                        <option value="2" {{ request('credit_hour') == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ request('credit_hour') == '3' ? 'selected' : '' }}>3</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="type" class="form-select">
                        <option value="">Select Type</option>
                        <option value="Theory" {{ request('type') == 'Theory' ? 'selected' : '' }}>Theory</option>
                        <option value="Sessional" {{ request('type') == 'Sessional' ? 'selected' : '' }}>Sessional</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('gotoAdminCourse') }}" class="btn btn-secondary">Clear</a>
                </div>
            </div>
        </form>

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
