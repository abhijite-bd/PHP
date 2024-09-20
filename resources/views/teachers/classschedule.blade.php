<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule a Class</title>

    {{-- Include Bootstrap CSS --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">


        {{-- Table for Distributions --}}
        <h2>Distributions</h2>

        {{-- Table for Distributions --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Last Date of Class</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($distributions as $distribution)
                <tr>
                    <td>{{ $distribution->course }}</td>
                    <td>{{ $distribution->course_name }}</td>
                    <td>{{ $distribution->last_date ?? 'Not Scheduled' }}</td>
                    <td>{{ $distribution->times ?? 'No Time Scheduled' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Scheduled Courses</h2>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- Table for Scheduled Courses --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scheduledCourses as $schedule)
                <tr>
                    <td>{{ $schedule->course_code }}</td>
                    <td>{{ $schedule->course_name }}</td>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ $schedule->time }}</td>
                    <td>
                        <form action="{{ route('courses_schedule.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Form for Scheduling a Class --}}
        <h2>Schedule a Class</h2>

        {{-- Show validation errors, if any --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('gotoTeacherClassSchedule.store') }}" method="POST">
            @csrf {{-- Laravel CSRF protection --}}

            {{-- Course Code Select --}}
            <div class="form-group">
                <label for="course_code">Course Code</label>
                <select name="course_code" id="course_code" class="form-control" required>
                    <option value="">Select Course Code</option>
                    @foreach ($distributions as $distribution)
                    <option value="{{ $distribution->course }}">{{ $distribution->course }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Course Name Input --}}
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" name="course_name" id="course_name" class="form-control" readonly>
            </div>

            {{-- Date Input --}}
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            {{-- Day Input --}}
            <div class="form-group">
                <label for="day">Day</label>
                <input type="text" name="day" id="day" class="form-control" placeholder="e.g., Monday" readonly required>
            </div>

            {{-- Time Input --}}
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" name="time" id="time" class="form-control" required>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary">Save Class Schedule</button>
        </form>

        {{-- Display saved schedule if exists --}}
        @if (session('schedule'))
        <div class="mt-4">
            <h3>Saved Class Schedule</h3>
            <ul class="list-group">
                <li class="list-group-item">Course Code: {{ session('schedule.course_code') }}</li>
                <li class="list-group-item">Course Name: {{ session('schedule.course_name') }}</li>
                <li class="list-group-item">Date: {{ session('schedule.date') }}</li>
                <li class="list-group-item">Day: {{ session('schedule.day') }}</li>
                <li class="list-group-item">Time: {{ session('schedule.time') }}</li>
            </ul>
        </div>
        @endif
    </div>

    {{-- Include Bootstrap JS and dependencies --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- JavaScript to handle day and course name --}}
    <script>
        const courses = @json($courses);

        document.getElementById('date').addEventListener('change', function() {
            const dateInput = this.value;
            const dayInput = document.getElementById('day');

            if (dateInput) {
                const date = new Date(dateInput);
                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                const dayOfWeek = days[date.getUTCDay()];
                dayInput.value = dayOfWeek;
            } else {
                dayInput.value = '';
            }
        });

        document.getElementById('course_code').addEventListener('change', function() {
            const selectedCode = this.value;
            const courseNameInput = document.getElementById('course_name');

            const selectedCourse = courses.find(course => course.code === selectedCode);
            if (selectedCourse !== undefined) {
                courseNameInput.value = selectedCourse.name;
            } else {
                courseNameInput.value = '';
            }
        });
    </script>

</body>

</html>