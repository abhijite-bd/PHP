<!DOCTYPE html>
<html>

<head>
    <title>Teacher List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
            <h1>Teacher List</h1>
            <a href="{{ route('gotoTeacherSignupPage') }}" class="btn btn-primary">Add Teacher</a>
        </div>

        <!-- Success Message -->
        <div>
            @if(session()->has('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
            @endif
        </div>

        <!-- Teacher Table -->
        <div class="table-container">
            <table class="table table-bordered table-hover text-center" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->designation }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>
                            <a href="{{ route('teacher.edit', ['teacher' => $teacher]) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('teacher.destroy', ['teacher' => $teacher]) }}" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
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
