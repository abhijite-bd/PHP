@extends('layouts.master')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-4xl p-6 bg-white border border-gray-200 rounded-lg shadow sm:p-8 md:p-10 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" action="{{ route('addCourse') }}" method="POST">
            <div class="text-center mb-6">
                <img src="{{ asset('/images/notebook.png') }}" alt="Logo" class="w-16 h-16 mx-auto mb-4">
                <h5 class="text-2xl font-medium text-gray-900 dark:text-white">Add Course</h5>
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
                    <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course Code</label>
                    <input type="text" name="code" id="code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter Course Code"/>
                    @error('code')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course Name</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter Course Name"/>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Level</label>
                    <select id="level" name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                        <option value="4">Level 4</option>
                        <option value="5">Level 5</option>                
                    </select>
                    @error('level')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Semester</label>
                    <select id="semester" name="semester" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="i">Semester I</option>
                        <option value="ii">Semester II</option>         
                    </select>
                    @error('semester')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="degree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Degree</label>
                    <select id="degree" name="degree" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($degrees as $degree)
                            <option value="{{ $degree }}">{{ $degree }}</option>
                        @endforeach
                    </select>
                    @error('degree')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="credit_hour" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credit Hour</label>
                    <input type="text" name="credit_hour" id="credit_hour" placeholder="Enter credit hour" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"/>
                    @error('credit_hour')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select course type</label>
                    <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Theory">Theory</option>
                        <option value="Sessional">Sessional</option> 
                    </select>
                    @error('type')
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

        const countriesSelect = document.getElementById('countries');
        const choices = new Choices(countriesSelect, {
        searchEnabled: true,
        itemSelectText: '',
        });

    });
</script>
@endsection
