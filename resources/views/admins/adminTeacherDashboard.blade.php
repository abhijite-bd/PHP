@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Teacher List</h1>
        <a href="{{ route('gotoTeacherSignupPage') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add Teacher</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('gotoAdminTeacher') }}" class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <select name="department" class="form-select w-full border rounded px-3 py-2">
                    <option value="">Select Department</option>
                    <option value="1" {{ request('department') == '1' ? 'selected' : '' }}>CSE</option>
                    <option value="2" {{ request('department') == '2' ? 'selected' : '' }}>EEE</option>
                    <option value="3" {{ request('department') == '3' ? 'selected' : '' }}>ECE</option>
                </select>
            </div>
            <div>
                <select name="designation" class="form-select w-full border rounded px-3 py-2">
                    <option value="">Select Designation</option>
                    <option value="Professor" {{ request('designation') == 'Professor' ? 'selected' : '' }}>Professor</option>
                    <option value="Lecturer" {{ request('designation') == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                    <option value="Associate Professor" {{ request('designation') == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                    <option value="Assistant Professor" {{ request('designation') == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                </select>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Filter</button>
                <a href="{{ route('gotoAdminTeacher') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Clear</a>
            </div>
        </div>
    </form>

    <!-- Success Message -->
    @if(session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center mb-8">
        {{ session('success') }}
    </div>
    @endif

    <!-- Teacher Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse w-full border border-gray-300">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Designation</th>
                    <th class="py-2 px-4 border">Department</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Edit</th>
                    <th class="py-2 px-4 border">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border">{{ $teacher->name }}</td>
                    <td class="py-2 px-4 border">{{ $teacher->designation }}</td>
                    <td class="py-2 px-4 border">
                        @if($teacher->department == 1)
                        CSE
                        @elseif($teacher->department == 2)
                        EEE
                        @elseif($teacher->department == 3)
                        ECE
                        @endif
                    </td>
                    <td class="py-2 px-4 border">{{ $teacher->email }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('teacher.edit', ['teacher' => $teacher]) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded">Edit</a>
                    </td>
                    <td class="py-2 px-4 border">
                        <form method="post" action="{{ route('teacher.destroy', ['teacher' => $teacher]) }}" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection