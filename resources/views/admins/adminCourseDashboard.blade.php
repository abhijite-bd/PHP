@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold">Course List</h1>
        <a href="{{ route('gotoAddCoursePage') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add Course</a>
    </div>

    <!-- Success Message -->
    @if(session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center mb-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- Filter Form -->
    <form method="GET" action="{{ route('gotoAdminCourse') }}" class="mb-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <select name="level" class="form-select w-full border rounded px-3 py-2">
                <option value="">Select Level</option>
                <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>Level 1</option>
                <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>Level 2</option>
                <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>Level 3</option>
                <option value="4" {{ request('level') == '4' ? 'selected' : '' }}>Level 4</option>
            </select>
            <select name="semester" class="form-select w-full border rounded px-3 py-2">
                <option value="">Select Semester</option>
                <option value="i" {{ request('semester') == 'i' ? 'selected' : '' }}>Semester I</option>
                <option value="ii" {{ request('semester') == 'ii' ? 'selected' : '' }}>Semester II</option>
            </select>
            <select name="credit_hour" class="form-select w-full border rounded px-3 py-2">
                <option value="">Select Credit</option>
                <option value="0.75" {{ request('credit_hour') == '0.75' ? 'selected' : '' }}>0.75</option>
                <option value="1" {{ request('credit_hour') == '1' ? 'selected' : '' }}>1</option>
                <option value="1.5" {{ request('credit_hour') == '1.5' ? 'selected' : '' }}>1.5</option>
                <option value="2" {{ request('credit_hour') == '2' ? 'selected' : '' }}>2</option>
                <option value="3" {{ request('credit_hour') == '3' ? 'selected' : '' }}>3</option>
            </select>
            <select name="type" class="form-select w-full border rounded px-3 py-2">
                <option value="">Select Type</option>
                <option value="Theory" {{ request('type') == 'Theory' ? 'selected' : '' }}>Theory</option>
                <option value="Sessional" {{ request('type') == 'Sessional' ? 'selected' : '' }}>Sessional</option>
            </select>
            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Filter</button>
                <a href="{{ route('gotoAdminCourse') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Clear</a>
            </div>
        </div>
    </form>

    <!-- Course List Table -->
    <div class="table-container overflow-x-auto">
        <table class="min-w-full border-collapse w-full border border-gray-300">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4 border">Course Code</th>
                    <th class="py-2 px-4 border">Course Name</th>
                    <th class="py-2 px-4 border">Level</th>
                    <th class="py-2 px-4 border">Semester</th>
                    <th class="py-2 px-4 border">Credit</th>
                    <th class="py-2 px-4 border">Type</th>
                    <th class="py-2 px-4 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $course->code }}</td>
                    <td class="py-2 px-4 border">{{ $course->name }}</td>
                    <td class="py-2 px-4 border">{{ $course->level }}</td>
                    <td class="py-2 px-4 border">{{ $course->semester }}</td>
                    <td class="py-2 px-4 border">{{ $course->credit_hour }}</td>
                    <td class="py-2 px-4 border">{{ $course->type }}</td>
                    <td class="py-2 px-4 border">
                        <form method="post" action="{{ route('course.destroy', ['course' => $course]) }}" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('delete')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection