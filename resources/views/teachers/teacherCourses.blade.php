@extends('layouts.master')

@section('content')
<div class="container mx-auto">
    

    <div class="w-full mb-5 p-6 bg-green-300 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <img src="{{ asset('images/assigned.png') }}" class="h-10 w-10 mb-2" alt="Logo" />
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Your Courses</h5>
        
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the Courses distributed to you.</p>
        
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">    

        @foreach ($courses as $course)
            @foreach ($cs as $c)
            @if($c->code == $course->course)
            <a href="{{ route('gotoTeachersCourseViewPage', ['code' => $course->course, 'session' => $course->session]) }}" class="flex flex-col items-center bg-white border border-green-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">            
                   <div class="flex flex-col justify-between p-6 leading-normal">                   
                       <h5 class="mb-2 text-xl font-bold tracking-tight text-green-600 dark:text-white">{{$course->course}}</h5>
                       <p class="font-normal text-gray-700 dark:text-gray-400">{{$c->name}}</p>
                      <p class="italic mt-2 text-sm text-gray-700 dark:text-gray-400">{{$c->type}}</p>
                       <p class="italic mt-2 text-sm text-gray-700 dark:text-gray-400">Session: {{$course->session}}</p>
                   </div>
            </a>
        @endif
        @endforeach
        @endforeach

    </div>

</div>


@endsection
