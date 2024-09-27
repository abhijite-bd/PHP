<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Validation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Result Validation</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form class="mb-4" method="GET" action="{{ route('resultValidation') }}">
            <div class="form-row">
                <div class="col">
                    <input type="text" name="s_id" class="form-control" placeholder="Student ID" value="{{ request('s_id') }}">
                </div>
                <div class="col">
                    <select name="level" class="form-control">
                        <option value="">Select Level</option>
                        <option value="1" {{ request('level') == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ request('level') == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ request('level') == 3 ? 'selected' : '' }}>3</option>
                        <option value="4" {{ request('level') == 4 ? 'selected' : '' }}>4</option>
                    </select>
                </div>
                <div class="col">
                    <select name="semester" class="form-control">
                        <option value="">Select Semester</option>
                        <option value="i" {{ request('semester') == 'i' ? 'selected' : '' }}>I</option>
                        <option value="ii" {{ request('semester') == 'ii' ? 'selected' : '' }}>II</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Level</th>
                    <th>Semester</th>
                    <th>CGPA</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->s_id }}</td>
                        <td>{{ $student->level }}</td>
                        <td>{{ $student->semester }}</td>
                        <td>{{ $student->cgpa }}</td>
                        <td>
                            <form action="{{ route('validateCgpa', $student->id) }}" method="POST">
                                @csrf
                                <select name="is_valid" class="form-control d-inline" style="width: auto;">
                                    <option value="1">Valid</option>
                                    <option value="0">Not Valid</option>
                                </select>
                                <button type="submit" class="btn btn-success">Validate</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
