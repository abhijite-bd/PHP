@extends('layouts.master')

@section('content')

<h2 class="text-3xl font-semibold mb-6 text-center">Class Schedule</h2>

<div class="flex justify-center mt-8">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
    <thead class="bg-gray-800 text-white">
    <tr>
        <th class="py-2 px-4 border-b border-gray-200">Course Code</th>
        <th class="py-2 px-4 border-b border-gray-200">Course Name</th>
        <th class="py-2 px-4 border-b border-gray-200">Date</th>
        <th class="py-2 px-4 border-b border-gray-200">Day</th>
        <th class="py-2 px-4 border-b border-gray-200">Time</th>
    </tr>
</thead>
<tbody>
    @foreach ($schedules as $schedule)
    <tr class="hover:bg-gray-100">
        <td class="py-2 px-4 border-b border-gray-200 w-48 text-center">{{ $schedule->course_code }}</td> <!-- Set width for course code -->
        <td class="py-2 px-4 border-b border-gray-200 w-64 text-center">{{ $schedule->course_name }}</td> <!-- Set width for course name -->
        <td class="py-2 px-4 border-b border-gray-200 w-48 text-center">{{ $schedule->date }}</td> <!-- Set width for date -->
        <td class="py-2 px-4 border-b border-gray-200 w-32 text-center">{{ $schedule->day }}</td> <!-- Set width for day -->
        <td class="py-2 px-4 border-b border-gray-200 w-32 text-center">{{ $schedule->time }}</td> <!-- Set width for time -->
    </tr>
    @endforeach
</tbody>

    </table>
</div>
@endsection