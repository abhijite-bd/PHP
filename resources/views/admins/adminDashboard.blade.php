@extends('layouts.master')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <table style="width: 90%; height: 80vh; border-collapse: collapse;">
        <tr>
            <td class="card-td w-1/2">
                <!-- Student Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg h-full w-full cursor-pointer hover:bg-gray-100" onclick="location.href='{{ route('gotoAdminStudent') }}';">
                        <div class="card-body flex flex-col justify-center items-center">
                            <h3 class="card-title text-2xl font-semibold">Students</h3>
                        </div>
                    </div>
                </div>
            </td>
            <td class="card-td w-1/2">
                <!-- Teacher Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg h-full w-full cursor-pointer hover:bg-gray-100" onclick="location.href='{{ route('gotoAdminTeacher') }}';">
                        <div class="card-body flex flex-col justify-center items-center">
                            <h3 class="card-title text-2xl font-semibold">Teachers</h3>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="card-td w-1/2">
                <!-- Course Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg h-full w-full cursor-pointer hover:bg-gray-100" onclick="location.href='{{ route('gotoAdminCourse') }}';">
                        <div class="card-body flex flex-col justify-center items-center">
                            <h3 class="card-title text-2xl font-semibold">Courses</h3>
                        </div>
                    </div>
                </div>
            </td>
            <td class="card-td w-1/2">
                <!-- Course Distribution Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg h-full w-full cursor-pointer hover:bg-gray-100" onclick="location.href='{{ route('gotoAdminCourseDist') }}';">
                        <div class="card-body flex flex-col justify-center items-center">
                            <h3 class="card-title text-2xl font-semibold">Course Distributions</h3>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
@endsection