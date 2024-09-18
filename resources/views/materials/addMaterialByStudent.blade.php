@extends('layouts.master')

@section('content3')

        <li>
            <a href="{{ route('gotoUploadMaterialByStudentPage') }}" class="block py-2 px-3 {{ request()->routeIs('gotoUploadMaterialByStudentPage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Your Resources</a>
        </li>
@endsection

@section('content')
<div class="container mx-auto">

    <div class="w-full mb-5 p-6 bg-green-300 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Your Materials</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">You can save materials for yourself from here.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="flex flex-col w-full bg-white border-gray-200 rounded-lg sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700  min-h-full">
                    <form class="space-y-6" action="{{ route('addStudentMaterial') }}" method="POST" enctype="multipart/form-data">
                        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Upload Material</h5>
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
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="title" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Content Title"/>
                            @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description*</label>
                            <textarea id="description" name="description" rows="4" class="block mt-1 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>                        
                        
                        <div class="mb-4">                        
                            <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Product Image (optional)</label>
                            <input id="file" name="file" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            @error('file')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload Material</button>
                        
                        
                    </form>
                </div>
                <div class="flex flex-col w-full bg-white border-gray-200 rounded-lg sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700  min-h-full">
                    <h5 class="text-xl mb-5 font-medium text-gray-900 dark:text-white">Previous Materials</h5>
                    
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
                                        <form action="{{ route('editStudentMaterial', $material->id) }}" method="POST" enctype="multipart/form-data">
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


@endsection
