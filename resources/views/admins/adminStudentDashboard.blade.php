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
