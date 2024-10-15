@extends('layouts.master')

@section('content')

<h2 class="text-3xl font-semibold mb-6 text-center">Class Schedule</h2>
<div class="mb-6 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">Reminder Settings</h5>
    </div>

    <!-- Toggle Switch -->
    <div class="flex items-center mb-4">
        <label for="reminder-toggle" class="inline-flex relative items-center cursor-pointer">
            <input type="checkbox" id="reminder-toggle" class="sr-only peer" onchange="toggleReminder()" {{ $reminder ? 'checked' : '' }}>
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Reminder</span>
        </label>
    </div>

    <!-- Reminder Time Input (Visible if a reminder exists) -->
    <form id="reminder-form" action="{{ route('saveReminder') }}" method="POST" class="{{ $reminder ? '' : 'hidden' }}">
        @csrf
        <div class="mb-4">
            <label for="reminder_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reminder Time (in minutes)</label>
            <input type="number" id="reminder_time" name="reminder_time" min="1"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                value="{{ $reminder ? $reminder->reminder_time : '' }}" required>
        </div>
        <input type="hidden" name="student_id" value="{{ $user->id }}">
        <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Set Reminder</button>
    </form>

    <!-- Form to Delete Reminder -->
    <form id="delete-reminder-form" action="{{ route('deleteReminder') }}" method="POST" class="{{ $reminder ? 'hidden' : '' }}">
        @csrf
        @method('delete')
        <input type="hidden" name="student_id" value="{{ $user->id }}">
        <button type="submit" class="w-full text-red-600 hover:text-red-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Delete Reminder</button>
    </form>
</div>

<script>
    function toggleReminder() {
        const reminderToggle = document.getElementById('reminder-toggle');
        const reminderForm = document.getElementById('reminder-form');
        const deleteForm = document.getElementById('delete-reminder-form');

        if (reminderToggle.checked) {
            reminderForm.classList.remove('hidden');
            deleteForm.classList.add('hidden');
        } else {
            reminderForm.classList.add('hidden');
            deleteForm.classList.remove('hidden');
        }
    }
</script>

<div class="flex justify-center mt-8">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-2 px-4 border-b border-gray-200">Course Code</th>
                <th class="py-2 px-4 border-b border-gray-200">Course Name</th>
                <th class="py-2 px-4 border-b border-gray-200">Date</th>
                <th class="py-2 px-4 border-b border-gray-200">Day</th>
                <th class="py-2 px-4 border-b border-gray-200">Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b border-gray-200 w-48 text-center">{{ $schedule->course_code }}</td> <!-- Set width for course code -->
                <td class="py-2 px-4 border-b border-gray-200 w-64 text-center">{{ $schedule->course_name }}</td> <!-- Set width for course name -->
                <td class="py-2 px-4 border-b border-gray-200 w-48 text-center">{{ $schedule->date }}</td> <!-- Set width for date -->
                <td class="py-2 px-4 border-b border-gray-200 w-32 text-center">{{ $schedule->day }}</td> <!-- Set width for day -->
                <td class="py-2 px-4 border-b border-gray-200 w-32 text-center">{{ $schedule->time }}</td> <!-- Set width for time -->
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection