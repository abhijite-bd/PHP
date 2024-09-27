<!-- resources/views/cgpa/form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Entry Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Enter CGPA for Each Level & Semester</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('cgpa.store') }}" method="POST" id="cgpaForm">
            @csrf

            @php
                $levels = [
                    'l1s1' => 'Level 1 - Semester 1',
                    'l1s2' => 'Level 1 - Semester 2',
                    'l2s1' => 'Level 2 - Semester 1',
                    'l2s2' => 'Level 2 - Semester 2',
                    'l3s1' => 'Level 3 - Semester 1',
                    'l3s2' => 'Level 3 - Semester 2',
                    'l4s1' => 'Level 4 - Semester 1',
                    'l4s2' => 'Level 4 - Semester 2',
                ];
            @endphp

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Level - Semester</th>
                        <th>CGPA</th>
                        <th>Validate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($levels as $field => $label)
                    <tr>
                        <td>{{ $label }}</td>
                        <td>
                            <input type="number" name="{{ $field }}" class="form-control" step="0.01" min="0" max="4">
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning validate-btn" data-field="{{ $field }}">Validate</button>
                            <span class="status-text text-danger ml-2">Not Validated</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.validate-btn').on('click', function () {
                let button = $(this);
                let field = button.data('field');
                let cgpaValue = $('input[name="' + field + '"]').val();

                if (cgpaValue === '' || cgpaValue < 0 || cgpaValue > 4) {
                    alert('Please enter a valid CGPA between 0 and 4.');
                    return;
                }

                // AJAX request to update validation status
                $.ajax({
                    url: '{{ route("cgpa.validate") }}',
                    method: 'POST',
                    data: {
                        field: field,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        button.prop('disabled', true).text('Pending');
                        button.siblings('.status-text').text('Validated').removeClass('text-danger').addClass('text-success');
                    },
                    error: function () {
                        alert('Failed to validate CGPA.');
                    }
                });
            });
        });
    </script>
</body>
</html>
