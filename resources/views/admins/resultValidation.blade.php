@extends('layouts.master')

@section('content')

<div class="text-center mb-6">
    <img src="{{ asset('/images/result.png') }}" alt="Logo" class="w-16 h-16 mx-auto mb-4">
    <h1 class="text-center text-3xl font-bold mb-8">Result</h1>
</div>
<div class="container mx-auto mt-8 px-4 md:px-8">

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        {{ session('success') }}
    </div>
    @endif
</div>
<div class="container mx-auto mt-8 px-4 md:px-8">
    <form class="mb-4" method="GET" action="{{ route('resultValidation') }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" name="s_id" class="form-input border border-gray-300 rounded-md w-full" placeholder="Student ID" value="{{ request('s_id') }}">
            </div>
            <div>
                <select name="level" class="form-select border border-gray-300 rounded-md w-full">
                    <option value="">Select Level</option>
                    <option value="1" {{ request('level') == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ request('level') == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ request('level') == 3 ? 'selected' : '' }}>3</option>
                    <option value="4" {{ request('level') == 4 ? 'selected' : '' }}>4</option>
                </select>
            </div>
            <div>
                <select name="semester" class="form-select border border-gray-300 rounded-md w-full">
                    <option value="">Select Semester</option>
                    <option value="i" {{ request('semester') == 'i' ? 'selected' : '' }}>I</option>
                    <option value="ii" {{ request('semester') == 'ii' ? 'selected' : '' }}>II</option>
                </select>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Filter</button>
                <a href="{{ route('resultValidation') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">Clear</a>
                <a href="{{ route('editCgpa', ['id' => 0]) }}" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">Create</a>
            </div>
        </div>
    </form>

    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border border-gray-300">No</th>
                <th class="py-2 px-4 border border-gray-300">ID</th>
                <th class="py-2 px-4 border border-gray-300">Name</th>
                <th class="py-2 px-4 border border-gray-300">Level</th>
                <th class="py-2 px-4 border border-gray-300">Semester</th>
                <th class="py-2 px-4 border border-gray-300">Sem1</th>
                <th class="py-2 px-4 border border-gray-300">Sem2</th>
                <th class="py-2 px-4 border border-gray-300">Sem3</th>
                <th class="py-2 px-4 border border-gray-300">Sem4</th>
                <th class="py-2 px-4 border border-gray-300">Sem5</th>
                <th class="py-2 px-4 border border-gray-300">Sem6</th>
                <th class="py-2 px-4 border border-gray-300">Sem7</th>
                <th class="py-2 px-4 border border-gray-300">Sem8</th>
                <th class="py-2 px-4 border border-gray-300">Edit</th>
                <th class="py-2 px-4 border border-gray-300">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($mergedData as $student)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border border-gray-300">{{ $i++ }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->s_id }}</td>
                <td class="py-2 px-4 border border-gray-300 w-48 text-center">{{ $student->name }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->level }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->semester }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->sem1 }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->sem2 }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->sem3 }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->sem4 }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->sem5 }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->sem6 }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->sem7  }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $student->sem8 }}</td>
                <td class="py-2 px-4 border border-gray-300">
                    <a href="{{ route('editCgpa', ['id' => $student->id]) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                </td>
                <td class="py-2 px-4 border border-gray-300">
                    <form action="{{ route('deleteCgpa', $student->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="14" class="text-center py-2">No results found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection