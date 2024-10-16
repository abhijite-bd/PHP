@extends('layouts.master')

@section('content')

<div class="container mx-auto mt-5 px-4 md:px-8">
    <div class="text-center mb-6">
        <img src="{{ asset('/images/result.png') }}" alt="Logo" class="w-16 h-16 mx-auto mb-4">
        <h1 class="text-center text-3xl font-bold mb-8">Exam Schedule</h1>
    </div>
    <div class="flex justify-center mt-8">

        <!-- Filter Form -->
        <form method="GET" action="{{ route('viewexam') }}" class="mb-4">
            <div class="flex space-x-4">
                <input type="text" name="course_code" placeholder="Course Code" class="border border-gray-300 px-3 py-2 rounded" value="{{ request('course_code') }}">
                <input type="text" name="course_name" placeholder="Course Name" class="border border-gray-300 px-3 py-2 rounded" value="{{ request('course_name') }}">
                <select name="status" class="border border-gray-300 px-3 py-2 rounded">
                    <option value="">All</option>
                    <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming Exams</option>
                    <option value="previous" {{ request('status') == 'previous' ? 'selected' : '' }}>Previous Exams</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
                <a href="{{ route('gotoTeachersExamPage') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Clear</a>
            </div>
        </form>
    </div>
    <div class="flex justify-center mt-8">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 w-44 text-center">Course Code</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-44 text-center">Course Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-44 text-center">Teacher</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-44 text-center">Type</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-44 text-center">Date</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-44 text-center">Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($exams as $exam)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $exam->course_code }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $exam->course_name }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $exam->teacher }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ is_array($exam->type) ? implode(', ', $exam->type) : $exam->type }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $exam->date }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $exam->time }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="border-b text-center py-4">No exams found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection