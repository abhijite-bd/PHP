@extends('layouts.master')

@section('content')
<div class="container-fluid p-5">
    <table style="width: 90%; height: 80vh; border-collapse: collapse;"> <!-- Adjust table size -->
        <tr>
            <td style="width: 50%; height: 50%; text-align: center; vertical-align: middle; font-size: 2rem; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <!-- Student Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg" style="height: 100%; width: 100%;" onclick="location.href='{{ route('gotoAdminStudent') }}';">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="card-title">Student</h3>
                        </div>
                    </div>
                </div>
            </td>
            <td style="width: 50%; height: 50%; text-align: center; vertical-align: middle; font-size: 2rem; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <!-- Course Distribution Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg" style="height: 100%; width: 100%;" onclick="location.href='{{ route('gotoAdminCourseDist') }}';">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="card-title">Course Distribution</h3>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; height: 40%; text-align: center; vertical-align: middle; font-size: 2rem; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"> <!-- Font size increased, scale effect added -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg" style="height: 100%; width: 100%;" onclick="location.href='{{ route('gotoAdminCourse') }}';">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="card-title">Course</h3>
                        </div>
                    </div>
                </div>
            </td>
            <td style="width: 50%; height: 50%; text-align: center; vertical-align: middle; font-size: 2rem; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <!-- Teacher Card -->
                <div class="col-md-12 mb-4">
                    <div class="card text-center p-4 shadow-lg" style="height: 100%; width: 100%;" onclick="location.href='{{ route('gotoAdminTeacher') }}';">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="card-title">Teacher</h3>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
@endsection