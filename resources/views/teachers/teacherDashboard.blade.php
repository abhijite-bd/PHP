@extends('layouts.master')

@section('content')
<div class="container mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">    

        <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Your Courses</h5>
                <a href="{{ route('gotoTeachersCoursesPage') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
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
                                        {{$course->course}}
                                    </p>
                                    @foreach ($cs as $c)
                                    @if($c->code == $course->course)
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{$c->name}}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{$c->type}}
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>

</div>


@endsection
