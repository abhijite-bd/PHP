@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-center text-3xl font-bold mb-8">Result</h1>

    <!-- Display CGPA Result -->
    @if (isset($result))
    <div class="alert alert-info text-center bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
        <strong>CGPA:</strong> {{ number_format($result, 3) }}
    </div>
    @endif

    <!-- Display any validation errors -->
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="mb-6 flex items-center justify-center">
        <label for="numericInput" class="inline text-gray-700 font-medium mr-2">Student Id:</label>
        <input type="text" id="numericInput" class="mt-1 block w-64 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            placeholder="Enter Student Id" value="{{ $cgpa->s_id ?? '' }}">
    </div>


    <form id="resultForm" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <div class="table-container overflow-x-auto px-4 md:px-8">
            <table class="min-w-full border-collapse border border-gray-300 mx-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border text-left font-semibold w-1/4 text-center">Semester</th>
                        <th class="px-4 py-2 border text-left font-semibold w-1/4 text-center">CGPA</th>
                        <th class="px-4 py-2 border text-left font-semibold w-1/4 text-center">Total Credit</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 8; $i++)
                        <tr class="{{ $i % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                        <td class="px-4 py-2 border w-64 text-center">Level {{ ceil($i / 2) }} Semester {{ $i % 2 == 1 ? 1 : 2 }}</td>
                        <td class="px-4 py-2 border w-64 text-center">
                            <input type="number" step="0.01" name="{{ 'sem'.$i }}"
                                value="{{ isset($cgpa->{'sem'.$i}) ? $cgpa->{'sem'.$i} : '' }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="CGPA for Semester {{ $i }}" min="0" max="4">
                        </td>
                        <td class="px-4 py-2 border w-64 text-center">
                            <input type="number" name="credits[{{ $i }}]" value="{{ $credits[$i-1] }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" readonly>
                        </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>


        <button type="submit"
            class="w-1/2 mt-6 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mx-auto block">
            Update CGPA
        </button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.getElementById('resultForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent immediate form submission

        const studentId = document.getElementById('numericInput').value;

        if (studentId) {
            const routeUrl = "{{ route('saveResult', ['id' => ':id']) }}";
            this.action = routeUrl.replace(':id', studentId);
            this.submit(); // Submit the form after updating the action URL
        } else {
            alert('Please enter a valid Student ID.');
        }
    });
</script>

@endsection