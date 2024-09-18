@extends('layouts.master')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-4xl p-6 bg-white border border-gray-200 rounded-lg shadow sm:p-8 md:p-10 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" action="{{ route('distributeCourse') }}" method="POST">
            <div class="text-center mb-6">
                <img src="{{ asset('/images/notebook.png') }}" alt="Logo" class="w-16 h-16 mx-auto mb-4">
                <h5 class="text-2xl font-medium text-gray-900 dark:text-white">Distribute Course</h5>
            </div>
            @csrf
            @if(\Illuminate\Support\Facades\Session::has('error'))
                <div id="error-message" class="px-4 py-2 bg-red-600 text-white rounded-md shadow-sm text-sm mb-5">
                    {{ \Illuminate\Support\Facades\Session::get('error') }}
                </div>
            @endif

            @if(\Illuminate\Support\Facades\Session::has('success'))
                   <div id="success-message" class="px-4 py-2 bg-green-600 text-white rounded-md shadow-sm text-sm mb-5">
                       {{ \Illuminate\Support\Facades\Session::get('success') }}
                   </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="course" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Course</label>
                    <select id="course" name="course" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($courses as $course)
                            <option value="{{ $course -> code }}">{{ $course -> code }}</option>
                        @endforeach
                    </select>
                    @error('course')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                <label for="teacher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your teacher</label>
                    <select id="teacher" name="teacher" class="choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Select a teacher</option>    
                        @foreach ($teachers as $teacher)    
                            <option value="{{ $teacher -> email }}">{{ $teacher -> name }}</option>
                        @endforeach
                    </select>
                    @error('teacher')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="session" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Session</label>
                    <input type="number" name="session" id="session" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter Session"/>
                    @error('session')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add new Course</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000); // 5000 milliseconds = 5 seconds

        const teachersSelect = document.getElementById('teacher');        
        const choicesTeacher = new Choices(teachersSelect, {
            searchEnabled: true,
            itemSelectText: '',
        });

        const coursesSelect = document.getElementById('course');        
        const coursesTeacher = new Choices(coursesSelect, {
            searchEnabled: true,
            itemSelectText: '',
        });

    });
</script>
@endsection
