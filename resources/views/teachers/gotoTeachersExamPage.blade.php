@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-5 px-4 md:px-8">
    <h1 class="text-3xl font-semibold mb-6 text-center">Exam Management</h1>

    <div class="flex justify-center mb-3">
        <a href="{{ route('examcreate') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Exam</a>
    </div>

    <form method="GET" action="{{ route('gotoTeachersExamPagefilter') }}" class="mb-4">
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

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 w-48 text-center">Course Code</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-48 text-center">Course Name</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-48 text-center">Teacher</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-48 text-center">Type</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-48 text-center">Date</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-48 text-center">Time</th>
                    <th class="py-2 px-4 border-b border-gray-200 w-48 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                <tr class="hover:bg-gray-100">
                    <td class="border-b text-center">{{ $exam->course_code }}</td>
                    <td class="border-b text-center">{{ $exam->course_name }}</td>
                    <td class="border-b text-center">{{ $exam->teacher }}</td>
                    <td class="border-b text-center">{{ is_array($exam->type) ? implode(', ', $exam->type) : $exam->type }}</td>
                    <td class="border-b text-center">{{ $exam->date }}</td>
                    <td class="border-b text-center">{{ $exam->time }}</td>
                    <td class="border-b text-center">
                        <form action="{{ route('examdestroy', $exam->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection