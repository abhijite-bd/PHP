@extends('layouts.master')

@section('content')
<div class="container mx-auto py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
        <!-- Product Form -->
        <div class="w-1/3 px-3 mb-6 lg:mb-0">
            <div class="w-full bg-white rounded-lg shadow p-5">
                <h2 class="text-lg font-bold mb-4">Add Supplier</h2>
                <form action="{{ route('uploadSupplier') }}" method="POST">
                    @csrf
                    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <div class="text-sm mb-5 text-red-500">
                            {{ \Illuminate\Support\Facades\Session::get('error') }}
                        </div>
                    @endif

                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="text-sm mb-5 text-green-500">
                            {{ \Illuminate\Support\Facades\Session::get('success') }}
                        </div>
                    @endif
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Faculty Name</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300 sm:text-sm">
                        
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="faculty_code" class="block text-sm font-medium text-gray-700">Faculty Code</label>
                        <input type="text" id="faculty_code" name="faculty_code" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300 sm:text-sm">
                        
                        @error('faculty_code')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                        <div class="mb-4">
                            <label for="dean_id" class="block text-sm font-medium text-gray-700">Dean*</label>
                            <div class="relative">
                                <input type="hidden" id="dean_id" name="dean_id">
                                <div id="teacherSelect" class="mt-1 text-gray-700 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm cursor-pointer focus:outline-none focus:ring focus:border-blue-300 text-sm">
                                    Select a Dean
                                </div>
                                <div id="teacherDropdown" class="absolute left-0 w-full rounded-md shadow-lg bg-white z-10 hidden">
                                    <input type="text" id="teacherSearch" class="w-3/4 px-3 py-2 border border-gray-300 rounded-t-md focus:outline-none" placeholder="Search">                                
                                    <ul id="teacherList" class="border border-t-0 border-gray-300 rounded-b-md max-h-40 overflow-y-auto">
                                        @foreach ($teachers as $teacher)
                                            <li class="px-3 py-2 hover:bg-gray-200 cursor-pointer" data-id="{{ $teacher->name }}">{{ $teacher->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @error('dean_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                </form>
            </div>
        </div>        
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        // Handle supplier dropdown
        const teacherSelect = document.getElementById('supplierSelect');
        const teacherDropdown = document.getElementById('supplierDropdown');
        const teacherSearch = document.getElementById('supplierSearch');
        const teacherList = document.getElementById('supplierList');
        const teacherInput = document.getElementById('dean_id');

        teacherSelect.addEventListener('click', function() {
            teacherDropdown.classList.toggle('hidden');
        });

        teacherSearch.addEventListener('input', function() {
            const searchValue = teacherSearch.value.toLowerCase();
            const items = teacherList.getElementsByTagName('li');
            for (let item of items) {
                const itemText = item.textContent.toLowerCase();
                if (itemText.includes(searchValue)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            }
        });

        teacherList.addEventListener('click', function(e) {
            if (e.target.tagName === 'LI') {
                teacherInput.value = e.target.getAttribute('data-id');
                teacherSelect.textContent = e.target.textContent;
                teacherDropdown.classList.add('hidden');
            }
        });
    });
</script>


@endsection
