@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4 mt-4">
    <h2 class="text-2xl font-semibold mb-4 text-center">Distributions</h2>
    <div class="flex justify-center mt-8">

        {{-- Table for Distributions --}}
        <table class="min-w-1/2 bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Course Code</th>
                    <th class="border px-4 py-2">Course Name</th>
                    <th class="border px-4 py-2">Last Date of Class</th>
                    <th class="border px-4 py-2">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($distributions as $distribution)
                <tr>
                    <td class="border px-4 py-2">{{ $distribution->course }}</td>
                    <td class="border px-4 py-2">{{ $distribution->course_name }}</td>
                    <td class="border px-4 py-2">{{ $distribution->last_date ?? 'Not Scheduled' }}</td>
                    <td class="border px-4 py-2">{{ $distribution->times ?? 'No Time Scheduled' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h2 class="text-2xl font-semibold mt-8 mb-4 text-center">Scheduled Courses</h2>
    <div class="flex justify-center mt-8">
        {{-- Success Message --}}
        @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
    </div>
    {{-- Table for Scheduled Courses --}}
    <div class="flex justify-center mt-8">
        <table class="min-w-1/2 bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Course Code</th>
                    <th class="border px-4 py-2">Course Name</th>
                    <th class="border px-4 py-2">Date</th>
                    <th class="border px-4 py-2">Day</th>
                    <th class="border px-4 py-2">Time</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scheduledCourses as $schedule)
                <tr>
                    <td class="border px-4 py-2">{{ $schedule->course_code }}</td>
                    <td class="border px-4 py-2">{{ $schedule->course_name }}</td>
                    <td class="border px-4 py-2">{{ $schedule->date }}</td>
                    <td class="border px-4 py-2">{{ $schedule->day }}</td>
                    <td class="border px-4 py-2">{{ $schedule->time }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('courses_schedule.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Form for Scheduling a Class --}}
    <h2 class="text-2xl font-semibold mt-8 mb-4 text-center">Schedule a Class</h2>

    <div class="flex justify-center mt-8"> <!-- Flexbox container for centering -->
        <form action="{{ route('gotoTeacherClassSchedule.store') }}" method="POST" class="bg-white p-4 rounded shadow w-1/2"> <!-- Set a specific width for the form -->
            @csrf {{-- Laravel CSRF protection --}}

            {{-- Course Code Select --}}
            <div class="mb-4">
                <label for="course_code" class="block font-medium">Course Code</label>
                <select name="course_code" id="course_code" class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full" required> <!-- Changed to w-full -->
                    <option value="">Select Course Code</option>
                    @foreach ($distributions as $distribution)
                    <option value="{{ $distribution->course }}">{{ $distribution->course }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Course Name Input --}}
            <div class="mb-4">
                <label for="course_name" class="block font-medium">Course Name</label>
                <input type="text" name="course_name" id="course_name" class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full" readonly> <!-- Changed to w-full -->
            </div>

            {{-- Date Input --}}
            <div class="mb-4">
                <label for="date" class="block font-medium">Date</label>
                <input type="date" name="date" id="date" class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full" required> <!-- Changed to w-full -->
            </div>

            {{-- Day Input --}}
            <div class="mb-4">
                <label for="day" class="block font-medium">Day</label>
                <input type="text" name="day" id="day" class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full" placeholder="e.g., Monday" readonly required> <!-- Changed to w-full -->
            </div>

            {{-- Time Input --}}
            <div class="mb-4">
                <label for="time" class="block font-medium">Time</label>
                <input type="time" name="time" id="time" class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full" required> <!-- Changed to w-full -->
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">Save Class Schedule</button>
        </form>
    </div>


    {{-- Display saved schedule if exists --}}
    @if (session('schedule'))
    <div class="mt-4">
        <h3 class="text-xl font-semibold">Saved Class Schedule</h3>
        <ul class="bg-white border border-gray-300 rounded mt-2">
            <li class="p-2">Course Code: {{ session('schedule.course_code') }}</li>
            <li class="p-2">Course Name: {{ session('schedule.course_name') }}</li>
            <li class="p-2">Date: {{ session('schedule.date') }}</li>
            <li class="p-2">Day: {{ session('schedule.day') }}</li>
            <li class="p-2">Time: {{ session('schedule.time') }}</li>
        </ul>
    </div>
    @endif
</div>

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

@endsection