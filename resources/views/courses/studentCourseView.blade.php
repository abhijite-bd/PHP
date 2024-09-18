@extends('layouts.master')

@section('content3')
        <li>
            <a href="{{ route('gotoUploadMaterialByStudentPage', ['code' => $course->code, 'session' => $session]) }}" class="block py-2 px-3 {{ request()->routeIs('gotoUploadMaterialByTeacherPage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Your Materials</a>
        </li>
@endsection

@section('content')
<div class="container mx-auto">

    <div class="w-full mb-5 p-6 bg-green-300 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('gotoStudentCoursesPage') }}" class="inline-flex items-center px-3 py-2 mb-4 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <i class="fas fa-arrow-left me-2"></i> All Courses
        </a>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$course->code}}</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$course->name}}</p>
    </div>

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="material-tab" data-tabs-target="#material" type="button" role="tab" aria-controls="material" aria-selected="false">Materials</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="assignment-tab" data-tabs-target="#assignment" type="button" role="tab" aria-controls="assignment" aria-selected="false">Assignments</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="exam-tab" data-tabs-target="#exam" type="button" role="tab" aria-controls="exam" aria-selected="false">Exams</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 border border-gray-200 rounded-lg bg-white dark:bg-gray-800 shadow" id="material" role="tabpanel" aria-labelledby="material-tab">      
                          
                <div class="flex flex-col w-full bg-white border-gray-200 rounded-lg sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700  min-h-full">
                    <h5 class="text-xl mb-5 font-medium text-gray-900 dark:text-white">Previous Course Materials</h5>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">  
                        @foreach($materials as $material)
                        <div class="p-6 mb-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$material -> title}}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$material -> description}}</p>
                            @if($material -> file)
                            <a href="{{ route('downloadMaterial', $material->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Download Material
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                            @endif

                        </div> 
                        @endforeach   
                    </div>  
                </div>  
        </div>
        <div class="hidden p-4 border border-gray-200 rounded-lg bg-white dark:bg-gray-800 shadow" id="assignment" role="tabpanel" aria-labelledby="assignment-tab">

                    <div class="flex flex-col w-full bg-white border-gray-200 rounded-lg sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700  min-h-full">
                        <h5 class="text-xl mb-5 font-medium text-gray-900 dark:text-white">Previous Assignments</h5>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($assignments as $assignment)
                        
                        <div class="p-6 mb-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$assignment -> title}}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$assignment -> description}}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$assignment -> deadline}}</p>
                            @if($assignment -> file)
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Download Material
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                            @endif

                        </div> 
                        @endforeach   
                        </div>  
                    </div>  



                </div>
            
            
            </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="exam" role="tabpanel" aria-labelledby="exam-tab">
         
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the active tab from the session
        let activeTab = "{{ session('activeTab') }}";

        // Check if there's an active tab to switch to
        if (activeTab) {
            let tabElement = document.getElementById(activeTab + '-tab');
            let tabContentElement = document.getElementById(activeTab);
            if (tabElement && tabContentElement) {
                // Deactivate other tabs
                document.querySelectorAll('[role="tabpanel"]').forEach((content) => content.classList.add('hidden'));
                document.querySelectorAll('[role="tab"]').forEach((tab) => tab.classList.remove('active'));

                // Activate the selected tab
                tabElement.classList.add('active');
                tabContentElement.classList.remove('hidden');
            }
        }
    });
</script>


@endsection
