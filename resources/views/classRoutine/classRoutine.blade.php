@extends('layouts.master')

@section('content')
    <div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-6">Upload Class Routine</h2>
        <form action="/routine/upload" method="POST">
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
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
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
                    <label for="session" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Session</label>
                    <input type="text" name="session" id="session" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter Session"/>
                    @error('session')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-7 gap-4">
                <!-- First Row (Header) -->
                <div class="text-center font-semibold"></div>
                @for ($hour = 8; $hour < 17; $hour += 1.5)
                    <div class="text-center font-semibold">
                        {{ date('g:i A', strtotime($hour . ':00')) }} - {{ date('g:i A', strtotime(($hour + 1.5) . ':30')) }}
                    </div>
                @endfor

                <!-- Days and Input Boxes -->
                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $dayIndex => $day)
                    <div class="text-center font-semibold">
                        {{ $day }}
                    </div>
                    @for ($hour = 8; $hour < 17; $hour += 1.5)
                        <div>
                            <input type="text" name="routine[{{ $dayIndex + 1 }}][{{ $hour }}]" class="w-full p-2 border rounded">
                        </div>
                    @endfor
                @endforeach
            </div>
            <div class="mt-6 text-center">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">Submit</button>
            </div>
        </form>
    </div>
@endsection
