@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-10 p-5 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Add Exam</h1>

    <form action="{{ route('examstore') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="course_code" class="block text-gray-700 font-medium">Course Code</label>
            <select name="course_code" id="course_code" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-green-500" required>
                <option value="">Select Course Code</option>
                @foreach ($courseCodes as $courseCode)
                <option value="{{ $courseCode }}">{{ $courseCode }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="course_name" class="block text-gray-700 font-medium">Course Name</label>
            <input type="text" name="course_name" id="course_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-green-500" required readonly>
        </div>

        <div class="mb-4">
            <label for="teacher" class="block text-gray-700 font-medium">Teacher</label>
            <input type="text" name="teacher" id="teacher" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-green-500" required readonly value="{{$teacher_name}}">
        </div>

        <div class="mb-4">
            <label for="type" class="block text-gray-700 font-medium">Type</label>
            <select name="type[]" id="type" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-green-500" multiple required>
                <option value="quiz">Quiz</option>
                <option value="mid">Midterm</option>
                <option value="final">Final</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="date" class="block text-gray-700 font-medium">Date</label>
            <input type="date" name="date" id="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-green-500" required>
            <p id="day" class="mt-2 text-gray-500"></p>
        </div>

        <div class="mb-4">
            <label for="time" class="block text-gray-700 font-medium">Time</label>
            <input type="time" name="time" id="time" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-green-500" required>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-green-500">Save Exam</button>
        </div>
    </form>
</div>

<script>
    // Show day of the week when date is selected
    document.getElementById('date').addEventListener('change', function() {
        const date = new Date(this.value);
        const options = {
            weekday: 'long'
        };
        document.getElementById('day').innerText = date.toLocaleDateString('en-US', options);
    });

    // Update Course Name based on selected Course Code
    document.getElementById('course_code').addEventListener('change', function() {
        const courseCode = this.value;
        const courseNames = @json($courseNames); // Pass course names from the controller
        document.getElementById('course_name').value = courseNames[courseCode] || '';
    });
</script>

@endsection