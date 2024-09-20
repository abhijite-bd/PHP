@extends('layouts.master')

@section('content')
<div class="container mx-auto">
    <div class="w-full mb-5 p-6 bg-green-300 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mt-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$user->name}}</h5>
        <p class="mb-3 font-semibold text-gray-700 dark:text-gray-400">{{$user->degree}}</p>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Level: {{$user->level}}, Semester: {{$user->semester}}, Session: {{$user->session}}</p>
    </div>


    <p class="mt-2 mb-2 pl-2 font-semibold tracking-tight text-gray-900 dark:text-white">Class Routine</h5>

    <div class="mb-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Day</th>
                    @for ($hour = 8; $hour < 17; $hour +=1.5)
                        <th scope="col" class="px-6 py-3 text-center">
                        {{ date('g:i A', strtotime($hour . ':00')) }} - {{ date('g:i A', strtotime(($hour + 1.5) . ':30')) }}
                        </th>
                        @endfor
                </tr>
            </thead>
            <tbody>
                @foreach (['Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday'] as $dayIndex => $day)
                <tr class="border-b odd:bg-white even:bg-gray-50 dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                        {{ $day }}
                    </th>
                    @for ($hour = 8; $hour < 17; $hour +=1.5)
                        <td class="px-6 py-4 text-center">
                        @php
                        $timeSlot = date('g:i A', strtotime($hour . ':00')) . ' - ' . date('g:i A', strtotime(($hour + 1.5) . ':30'));
                        $class = $routines->where('weekday', $day)->where('time_slot', $timeSlot)->first();
                        @endphp
                        {{ $class ? $class->class_name : '-' }}
                        </td>
                        @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Your Courses</h5>
            <a href="{{ route('gotoStudentCoursesPage') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                View all
            </a>
        </div>
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($courses as $course)
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-1 min-w-0 ms-4">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                {{$course->code}}
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {{$course->name}}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            {{$course->type}}
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
@endsection