<!DOCTYPE html>
<html>

<head>
    <title>Teacher List</title>
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
            <h1>Teacher List</h1>
            <a href="{{ route('gotoTeacherSignupPage') }}" class="btn btn-primary">Add Teacher</a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('gotoAdminTeacher') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <select name="department" class="form-select">
                        <option value="">Select Department</option>
                        <option value="1" {{ request('department') == '1' ? 'selected' : '' }}>CSE</option>
                        <option value="2" {{ request('department') == '2' ? 'selected' : '' }}>EEE</option>
                        <option value="3" {{ request('department') == '3' ? 'selected' : '' }}>ECE</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="designation" class="form-select">
                        <option value="">Select Designation</option>
                        <option value="Professor" {{ request('designation') == 'Professor' ? 'selected' : '' }}>Professor</option>
                        <option value="Lecturer" {{ request('designation') == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                        <option value="Associate Professor" {{ request('designation') == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                        <option value="Assistant Professor" {{ request('designation') == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('gotoAdminTeacher') }}" class="btn btn-secondary">Clear</a>
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

        <!-- Teacher Table -->
        <div class="table-container">
            <table class="table table-bordered table-hover text-center" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
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
                        <td>
                            @if($teacher->department == 1)
                                CSE
                            @elseif($teacher->department == 2)
                                EEE
                            @elseif($teacher->department == 3)
                                ECE
                            @endif
                        </td>
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
