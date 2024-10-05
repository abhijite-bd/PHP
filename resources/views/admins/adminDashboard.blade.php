@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-10 px-4 md:px-12 md:py-12">
    <table style="width: 90%; height: 80vh; border-collapse: collapse;">
        <tr>
            <td class="card-td w-1/2">
                <!-- Student Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg h-full w-full cursor-pointer hover:bg-gray-100" onclick="location.href='{{ route('gotoAdminStudent') }}';">
                        <div class="card-body flex flex-col justify-center items-center">
                            <h3 class="card-title text-2xl font-semibold">Student</h3>
                        </div>
                    </div>
                </div>
            </td>
            <td class="card-td w-1/2">
                <!-- Course Distribution Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg h-full w-full cursor-pointer hover:bg-gray-100" onclick="location.href='{{ route('gotoAdminCourseDist') }}';">
                        <div class="card-body flex flex-col justify-center items-center">
                            <h3 class="card-title text-2xl font-semibold">Course Distribution</h3>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="card-td">
                <!-- Course Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg h-full w-full cursor-pointer hover:bg-gray-100" onclick="location.href='{{ route('gotoAdminCourse') }}';">
                        <div class="card-body flex flex-col justify-center items-center">
                            <h3 class="card-title text-2xl font-semibold">Course</h3>
                        </div>
                    </div>
                </div>
            </td>
            <td class="card-td">
                <!-- Teacher Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg h-full w-full cursor-pointer hover:bg-gray-100" onclick="location.href='{{ route('gotoAdminTeacher') }}';">
                        <div class="card-body flex flex-col justify-center items-center">
                            <h3 class="card-title text-2xl font-semibold">Teacher</h3>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
@endsection
