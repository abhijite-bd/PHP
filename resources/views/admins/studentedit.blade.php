@extends('layouts.master')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-4xl p-6 bg-white border border-gray-200 rounded-lg shadow sm:p-8 md:p-10 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" action="{{route('student.update',['student' => $student]) }}" method="POST">
            @csrf
            @method('put')
            <div class="text-center mb-6">
                <img src="{{ asset('/images/notebook.png') }}" alt="Logo" class="w-16 h-16 mx-auto mb-4">
                <h5 class="text-2xl font-medium text-gray-900 dark:text-white">Update Student</h5>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="s_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student ID</label>
                    <input type="text" name="s_id" id="s_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter Student ID" value="{{$student->s_id}}" />

                </div>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Name</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter Student's Name" value="{{$student->name}}" />
                    
                </div>
                <div>
                    <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Level</label>
                    <select id="level" name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1" {{ $student->level == 1 ? 'selected' : '' }}>Level 1</option>
                        <option value="2" {{ $student->level == 2 ? 'selected' : '' }}>Level 2</option>
                        <option value="3" {{ $student->level == 3 ? 'selected' : '' }}>Level 3</option>
                        <option value="4" {{ $student->level == 4 ? 'selected' : '' }}>Level 4</option>
                        <option value="5" {{ $student->level == 5 ? 'selected' : '' }}>Level 5</option>
                    </select>
                   
                </div>
                <div>
                    <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Semester</label>
                    <select id="semester" name="semester" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="i" {{ $student->semester == 'i' ? 'selected' : '' }}>Semester I</option>
                        <option value="ii" {{ $student->semester == 'ii' ? 'selected' : '' }}>Semester II</option>
                    </select>

                   
                </div>
                <div>
                    <label for="degree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Degree</label>
                    <input type="text" name="degree" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter Student's Name" value="{{$student->degree}}" />

                </div>
                <div>
                    <label for="session" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Session</label>
                    <input type="text" name="session" id="session" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter Session" value="{{$student->session}}" />

                </div>
                <div>
                    <label for=" email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" value="{{$student->email}}" />
                   
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="password" />

                </div>
            </div>
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Student</button>
        </form>
    </div>
</div>

@endsection