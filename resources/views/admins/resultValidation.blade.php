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
                    <a href="{{ route('resultValidation') }}" class="btn btn-secondary ml-2">Clear</a>
                </div>
            </div>
        </form>


        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Semester</th>
                    <th>Sem1</th>
                    <th>Sem2</th>
                    <th>Sem3</th>
                    <th>Sem4</th>
                    <th>Sem5</th>
                    <th>Sem6</th>
                    <th>Sem7</th>
                    <th>Sem8</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @forelse ($mergedData as $student)

                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $student->s_id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->level }}</td>
                    <td>{{ $student->semester }}</td>
                    <td>{{ $student->sem1 }}</td>
                    <td>{{ $student->sem2 }}</td>
                    <td>{{ $student->sem3 }}</td>
                    <td>{{ $student->sem4 }}</td>
                    <td>{{ $student->sem5 }}</td>
                    <td>{{ $student->sem6 }}</td>
                    <td>{{ $student->sem7 }}</td>
                    <td>{{ $student->sem8 }}</td>
                    <td>
                        <!-- Form to Validate CGPA -->
                        <form action="{{ route('validateCgpa', $student->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" name="is_valid" value="1" class="btn btn-success">Valid</button>
                        </form>

                        <!-- Form to Delete CGPA -->
                        <form action="{{ route('deleteCgpa', $student->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="14" align="center">No results found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>