@extends('layouts.master')

@section('content2')
<li>
    <a href="{{ route('gotoUploadMaterialByTeacherPage', ['code' => $course->code, 'session' => $session]) }}" class="block py-2 px-3 {{ request()->routeIs('gotoUploadMaterialByTeacherPage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Course Materials</a>
</li>
<li>
    <a href="{{ route('gotoUploadAssignmentByTeacherPage', ['code' => $course->code, 'session' => $session]) }}" class="block py-2 px-3 {{ request()->routeIs('addAssignment') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Assignments</a>
</li>
<li>
    <a href="{{ route('gotoTeacherClassSchedule', ['code' => $course->code, 'session' => $session]) }}" class="block py-2 px-3 {{ request()->routeIs('addAssignment') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Class Schedules</a>
</li>
@endsection

@section('content')
<div class="container mx-auto">

    <div class="w-full mb-5 p-6 bg-gray-400 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('gotoTeachersCoursesPage') }}" class="inline-flex items-center px-3 py-2 mb-4 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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

        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 border border-gray-200 rounded-lg bg-white dark:bg-gray-800 shadow" id="material" role="tabpanel" aria-labelledby="material-tab">

            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">



                <div class="flex flex-col w-full bg-white border-gray-200 rounded-lg sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700  min-h-full">
                    <h5 class="text-xl mb-5 font-medium text-gray-900 dark:text-white">Previous Course Materials</h5>

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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        @endif
                        <form action="{{ route('deleteMaterial', $material->id) }}" method="POST" class="inline-block mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                Delete
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M1 13L13 1" />
                                </svg>
                            </button>
                        </form>

                        <!-- Edit Material Button -->
                        <button data-modal-target="edit-material-modal-{{ $material->id }}" data-modal-toggle="edit-material-modal-{{ $material->id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800" type="button">
                            Edit
                        </button>

                        <!-- Edit Material Modal -->
                        <div id="edit-material-modal-{{ $material->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                            <div class="relative w-full h-full max-w-2xl md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Edit Material
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-material-modal-{{ $material->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="p-6 space-y-6">
                                        <form action="{{ route('editMaterial', $material->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $material->id }}">

                                            <div class="mb-4">
                                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                                <input type="text" name="title" id="title" value="{{ $material->title }}" class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                                @error('title')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $material->description }}</textarea>
                                                @error('description')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="file" class="block text-sm font-medium text-gray-700">Upload Material</label>
                                                <input id="file" name="file" type="file" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                                                @error('file')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="flex items-center justify-end p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Material Modal -->


                        <!-- Edit Material Modal -->
                        <div id="edit-success-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                            <div class="relative w-full h-full max-w-2xl md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Material Edited
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-material-modal-{{ $material->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Material Modal -->

                    </div>
                    @endforeach
                </div>



            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="assignment" role="tabpanel" aria-labelledby="assignment-tab">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="flex flex-col w-full bg-white border-gray-200 rounded-lg sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700  min-h-full">
                    <h5 class="text-xl mb-5 font-medium text-gray-900 dark:text-white">Previous Assignments</h5>

                    @foreach($assignments as $assignment)
                    <div class="p-6 mb-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$assignment -> title}}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$assignment -> description}}</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$assignment -> deadline}}</p>
                        @if($assignment -> file)
                        <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Download
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        @endif
                        <form action="{{ route('deleteAssignment', $assignment->id) }}" method="POST" class="inline-block mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                Delete Assignment
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M1 13L13 1" />
                                </svg>
                            </button>
                        </form>
                        <!-- Edit Material Button -->
                        <button data-modal-target="edit-assignment-modal-{{ $assignment->id }}" data-modal-toggle="edit-assignment-modal-{{ $assignment->id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800" type="button">
                            Edit
                        </button>

                        <!-- Edit Material Modal -->
                        <div id="edit-assignment-modal-{{ $assignment->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                            <div class="relative w-full h-full max-w-2xl md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Edit assignment
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-assignment-modal-{{ $assignment->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="p-6 space-y-6">
                                        <form action="{{ route('editAssignment', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $assignment->id }}">

                                            <div class="mb-4">
                                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                                <input type="text" name="title" id="title" value="{{ $assignment->title }}" class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                                @error('title')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $assignment->description }}</textarea>
                                                @error('description')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="file" class="block text-sm font-medium text-gray-700">Upload Material</label>
                                                <input id="file" name="file" type="file" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                                                @error('file')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline (YYYY-mm-dd)</label>
                                                <input type="text" name="deadline" id="deadline" value="{{ $assignment->deadline }}" class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                                @error('deadline')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="flex items-center justify-end p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Material Modal -->


                        <!-- Edit Material Modal -->
                        <div id="edit-success-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                            <div class="relative w-full h-full max-w-2xl md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Material Edited
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-assignment-modal-{{ $assignment->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Material Modal -->

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
    document.addEventListener('DOMContentLoaded', function() {
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