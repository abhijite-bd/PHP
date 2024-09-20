<!DOCTYPE html>
<html>

<head>
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom CSS if needed */
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h1>Student List</h1>
            <a href="{{ route('gotoStudentSignupPage') }}" class="btn btn-primary">Add Student</a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('gotoAdminStudent') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <select name="level" class="form-select">
                        <option value="">Select Level</option>
                        <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>Level 1</option>
                        <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>Level 2</option>
                        <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>Level 3</option>
                        <option value="4" {{ request('level') == '4' ? 'selected' : '' }}>Level 4</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="semester" class="form-select">
                        <option value="">Select Semester</option>
                        <option value="i" {{ request('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                        <option value="ii" {{ request('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('gotoAdminStudent') }}" class="btn btn-secondary">Clear</a>
                </div>
            </div>
        </form>

        <!-- Success Message -->
        <div>
            @if(session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
            @endif
        </div>

        <!-- Student Table -->
        <div class="d-flex justify-content-center align-items-center table-container">
            <table class="table table-bordered table-hover text-center" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Semester</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->s_id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->level }}</td>
                        <td>{{ $student->semester }}</td>
                        <td>
                            <a href="{{ route('student.edit', ['student' => $student]) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td>
                            <form method='post' action="{{ route('student.destroy', ['student' => $student]) }}" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
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
