@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-8 px-4 md:px-10">
    <div class="flex justify-between items-center my-4">
        <h1 class="text-2xl font-bold">Course Distribution</h1>
        <a href="{{ route('gotoDistributeCoursePage') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Distribute Course</a>
    </div>

    <!-- Success Message -->
    <div>
        @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center mb-4" role="alert">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <div>
        <!-- Filter Form -->
        <form method="GET" action="{{ route('gotoAdminCourseDist') }}" class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <input type="text" name="course_code" value="{{ request('course_code') }}" class="w-full p-2 border border-gray-300 rounded" placeholder="Course Code">
                </div>
                <div>
                    <input type="text" name="course_name" value="{{ request('course_name') }}" class="w-full p-2 border border-gray-300 rounded" placeholder="Course Name">
                </div>
                <div>
                    <input type="text" name="teacher_name" value="{{ request('teacher_name') }}" class="w-full p-2 border border-gray-300 rounded" placeholder="Teacher">
                </div>
                <div class="flex items-center space-x-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                    <a href="{{ route('gotoAdminCourseDist') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Clear</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Course Distribution Table -->
    <div class="table-container overflow-x-auto">
        <table class="min-w-full border-collapse w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="border border-gray-300 px-4 py-2">Course Code</th>
                    <th class="border border-gray-300 px-4 py-2">Course Name</th>
                    <th class="border border-gray-300 px-4 py-2">Teacher</th>
                    <th class="border border-gray-300 px-4 py-2">Session</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cdistributions as $cdistribution)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $cdistribution->course_code }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $cdistribution->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $cdistribution->teacher_name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $cdistribution->session }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <form method="post" action="{{ route('coursedist.destroy', ['cdistribution' => $cdistribution->course_code]) }}" onsubmit="return confirm('Are you sure you want to delete this course distribution?');">
                            @csrf
                            @method('delete')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection