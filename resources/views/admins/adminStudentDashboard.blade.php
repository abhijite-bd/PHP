@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-8 px-4 md:px-8">
    <div class="flex justify-between items-center my-4">
        <h1 class="text-2xl font-bold">Student List</h1>
        <a href="{{ route('gotoStudentSignupPage') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Student</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('gotoAdminStudent') }}" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" name="id" placeholder="Enter ID" class="w-full p-2 border border-gray-300 rounded" value="{{ request('id') }}">
            </div>
            <div>
                <select name="level" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Select Level</option>
                    <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>Level 1</option>
                    <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>Level 2</option>
                    <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>Level 3</option>
                    <option value="4" {{ request('level') == '4' ? 'selected' : '' }}>Level 4</option>
                </select>
            </div>
            <div>
                <select name="semester" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Select Semester</option>
                    <option value="i" {{ request('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                    <option value="ii" {{ request('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                <a href="{{ route('gotoAdminStudent') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Clear</a>
            </div>
        </div>
    </form>

    <!-- Success Message -->
    <div>
        @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center mb-4" role="alert">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <!-- Student Table -->
    <div class="table-container overflow-x-auto px-4 md:px-8">
        <table class="min-w-full border-collapse w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Level</th>
                    <th class="border border-gray-300 px-4 py-2">Semester</th>
                    <th class="border border-gray-300 px-4 py-2">Edit</th>
                    <th class="border border-gray-300 px-4 py-2">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $student->s_id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $student->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $student->level }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $student->semester }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('student.edit', ['student' => $student]) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <form method='post' action="{{ route('student.destroy', ['student' => $student]) }}" onsubmit="return confirm('Are you sure you want to delete this student?');">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection