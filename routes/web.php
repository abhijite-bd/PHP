<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ClassRoutineController;
use App\Http\Controllers\StudentMaterialController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login/student', [LoginController::class, 'gotoStudentLoginPage'])->name('gotoStudentLoginPage');
Route::get('/login/admin', [LoginController::class, 'gotoAdminLoginPage'])->name('gotoAdminLoginPage');
Route::get('/login/teacher', [LoginController::class, 'gotoTeacherLoginPage'])->name('gotoTeacherLoginPage');

Route::post('/studentlogin', [LoginController::class, 'loginStudent'])->name('loginStudent');
Route::post('/adminlogin', [LoginController::class, 'loginAdmin'])->name('loginAdmin');
Route::post('/teacherlogin', [LoginController::class, 'loginTeacher'])->name('loginTeacher');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/teacher/dashboard', [DashboardController::class, 'gotoTeacherDashboard'])->name('gotoTeacherDashboard');
Route::get('/teacher/dashboard/classschedule', [DashboardController::class, 'gotoTeacherClassSchedule'])->name('gotoTeacherClassSchedule');
Route::post('/teacher/dashboard/classschedule', [DashboardController::class, 'gotoTeacherClassScheduleStore'])->name('gotoTeacherClassSchedule.store');
Route::delete('/teacher/dashboard/classschedule/{id}/destroy', [DashboardController::class, 'courses_schedule_destroy'])->name('courses_schedule.destroy');

Route::get('/student/dashboard', [DashboardController::class, 'gotoStudentDashboard'])->name('gotoStudentDashboard');
Route::get('/student/dashboard/classschedule', [DashboardController::class, 'gotoStudentClassSchedule'])->name('gotoStudentClassSchedule');
Route::get('/student/dashboard/result', [DashboardController::class, 'gotoStudentResult'])->name('gotoResult');
Route::get('/admin/dashboard', [DashboardController::class, 'gotoAdminDashboard'])->name('gotoAdminDashboard');

Route::get('/admin/dashboard/student', [DashboardController::class, 'gotoAdminStudentDashboard'])->name('gotoAdminStudent');
Route::get('/admin/dashboard/teacher', [DashboardController::class, 'gotoAdminTeacherDashboard'])->name('gotoAdminTeacher');
Route::get('/admin/dashboard/course', [DashboardController::class, 'gotoAdminCourseDashboard'])->name('gotoAdminCourse');
Route::get('/admin/dashboard/coursedist', [DashboardController::class, 'gotoAdminCourseDistDashboard'])->name('gotoAdminCourseDist');

Route::get('/admin/dashboard/student/{student}/edit', [DashboardController::class, 'editstudent'])->name('student.edit');
Route::put('/admin/dashboard/student/{student}/update', [DashboardController::class, 'updatestudent'])->name('student.update');
Route::delete('/admin/dashboard/student/{student}/destroy', [DashboardController::class, 'destroystudent'])->name('student.destroy');

Route::get('/admin/dashboard/teacher/{teacher}/edit', [DashboardController::class, 'editteacher'])->name('teacher.edit');
Route::put('/admin/dashboard/teacher/{teacher}/update', [DashboardController::class, 'updateteacher'])->name('teacher.update');
Route::delete('/admin/dashboard/teacher/{teacher}/destroy', [DashboardController::class, 'destroyteacher'])->name('teacher.destroy');

Route::delete('/admin/dashboard/course/{course}/destroy', [DashboardController::class, 'destroycourse'])->name('course.destroy');

Route::delete('/admin/dashboard/coursedist/{cdistribution}/destroy', [DashboardController::class, 'destroycoursedist'])->name('coursedist.destroy');


Route::get('/signup/choice', [SignupController::class, 'gotoSignupChoicePage'])->name('gotoSignupChoicePage');

Route::get('/signup/student', [SignupController::class, 'gotoStudentSignupPage'])->name('gotoStudentSignupPage')->middleware(AdminMiddleware::class);
Route::get('/signup/admin', [SignupController::class, 'gotoAdminSignupPage'])->name('gotoAdminSignupPage')->middleware(AdminMiddleware::class);
Route::get('/signup/teacher', [SignupController::class, 'gotoTeacherSignupPage'])->name('gotoTeacherSignupPage')->middleware(AdminMiddleware::class);

Route::post('/studentsignup', [SignupController::class, 'signupStudent'])->name('signupStudent')->middleware(AdminMiddleware::class);
Route::post('/adminsignup', [SignupController::class, 'signupAdmin'])->name('signupAdmin')->middleware(AdminMiddleware::class);
Route::post('/teachersignup', [SignupController::class, 'signupTeacher'])->name('signupTeacher')->middleware(AdminMiddleware::class);


//Courses
Route::get('/course/add', [CourseController::class, 'gotoAddCoursePage'])->name('gotoAddCoursePage')->middleware(AdminMiddleware::class);
Route::post('/courseadd', [CourseController::class, 'addCourse'])->name('addCourse')->middleware(AdminMiddleware::class);
Route::get('/course/distribute', [CourseController::class, 'gotoDistributeCoursePage'])->name('gotoDistributeCoursePage')->middleware(AdminMiddleware::class);
Route::post('/coursedistribute', [CourseController::class, 'distributeCourse'])->name('distributeCourse')->middleware(AdminMiddleware::class);

//teacher's courses
Route::get('/course/teacher', [CourseController::class, 'gotoTeachersCoursesPage'])->name('gotoTeachersCoursesPage')->middleware(TeacherMiddleware::class);
Route::get('/teacher/course/{code}/{session}', [CourseController::class, 'gotoTeachersCourseViewPage'])->name('gotoTeachersCourseViewPage')->middleware(TeacherMiddleware::class);

//materialsupload
Route::get('/add/material/page/{code}/{session}', [MaterialController::class, 'gotoUploadMaterialByTeacherPage'])->name('gotoUploadMaterialByTeacherPage')->middleware(TeacherMiddleware::class);
Route::post('/add/material/{course_code}/{session}', [MaterialController::class, 'addMaterial'])->name('addMaterial')->middleware(TeacherMiddleware::class);
//Route::get('/download/material/{path}',[MaterialController::class,'downloadMaterial'])->name('downloadMaterial')->middleware(TeacherMiddleware::class);
//Route::get('/download/material/{file}', [MaterialController::class, 'downloadMaterial'])->name('downloadMaterial')->middleware(TeacherMiddleware::class);
Route::get('/download/material/{id}', [MaterialController::class, 'downloadMaterial'])->name('downloadMaterial');
Route::post('/edit/material/{id}', [MaterialController::class, 'editMaterial'])->name('editMaterial')->middleware(TeacherMiddleware::class);


Route::get('/add/assignment/page/{code}/{session}', [AssignmentController::class, 'gotoUploadAssignmentByTeacherPage'])->name('gotoUploadAssignmentByTeacherPage')->middleware(TeacherMiddleware::class);

Route::post('/add/assignment/{course_code}/{session}', [AssignmentController::class, 'addAssignment'])->name('addAssignment')->middleware(TeacherMiddleware::class);
Route::get('/download/assignment/{id}', [AssignmentController::class, 'downloadAssignment'])->name('downloadAssignment')->middleware(TeacherMiddleware::class);
Route::post('/edit/assignment/{id}', [AssignmentController::class, 'editAssignment'])->name('editAssignment')->middleware(TeacherMiddleware::class);

Route::get('/routine/upload', [ClassRoutineController::class, 'uploadPage'])->name('routine.upload.page');
Route::post('/routine/upload', [ClassRoutineController::class, 'upload'])->name('routine.upload');


Route::post('/add/material/student', [StudentMaterialController::class, 'addStudentMaterial'])->name('addStudentMaterial')->middleware(StudentMiddleware::class);
Route::get('/add/material/student', [StudentMaterialController::class, 'gotoUploadMaterialByStudentPage'])->name('gotoUploadMaterialByStudentPage')->middleware(StudentMiddleware::class);

Route::post('/edit/material/student/{id}', [StudentMaterialController::class, 'editStudentMaterial'])->name('editStudentMaterial')->middleware(StudentMiddleware::class);

Route::get('/course/student', [CourseController::class, 'gotoStudentCoursesPage'])->name('gotoStudentCoursesPage')->middleware(StudentMiddleware::class);
Route::get('/student/course/{code}/{session}', [CourseController::class, 'gotoStudentsCourseViewPage'])->name('gotoStudentsCourseViewPage')->middleware(StudentMiddleware::class);
