<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Distribution;
use App\Models\Course;
use App\Models\ClassRoutine;
use Illuminate\Support\Facades\Session;
use App\Models\Faculty;
use App\Models\Department;

class DashboardController extends Controller
{
    
    public function gotoAdminDashboard()
    {
        return view('admins.adminDashboard');
    }
    public function gotoStudentResult()
    {
        return view('students.resultpage');
    }

    public function gotoAdminStudentDashboard()
    {
        $students = Student::all();

        return view('admins.adminStudentDashboard', ['students' => $students]);
    }

    public function gotoAdminTeacherDashboard()
    {
        $teachers = Teacher::all();

        return view('admins.adminTeacherDashboard', ['teachers' => $teachers]);
    }
    public function gotoAdminCourseDistDashboard()
    {
        $cdistribution = Distribution::all();

        return view('admins.adminCourseDistDashboard', ['cdistributions' => $cdistribution]);
    }
    public function gotoAdminCourseDashboard()
    {
        $course = Course::all();

        return view('admins.adminCourseDashboard', ['courses' => $course]);
    }

    public function editstudent(Student $student)
    {
        // dd($student);
        return view('admins.studentedit', ['student' => $student]);
    }
    public function editteacher(Teacher $teacher)
    {
        // dd($student);
        return view('admins.teacheredit', [
            'teacher' => $teacher,
            'faculties' => ['Computer Science and Engineering', 'Agriculture', 'Engineering'],
            'departments' => ['CSE', 'EEE', 'ECE'],
            'designations' => ['Lecturer', 'Assistant Professor', 'Associate Professor', 'Professor'],
        ]);
    }
    public function updatestudent(Student $student, Request $request)
    {
        // $data = $request->validate([
        //     's_id' => 'required',
        //     'name' => 'required',
        //     'degree' => 'required',
        //     'level' => 'required',  
        //     'semester' => 'required',  
        //     'session' => 'required',
        //     'email' => 'required|email',  
        //     'password' => 'required',
        // ]);
        // if ($request->filled('password')) {
        //     $data['password'] = bcrypt($request->password);
        // } else {
        //     unset($data['password']);
        // }
        dd($student);
        // $student->update(($data));
        // return redirect(route('gotoAdminStudent'))->with('success', 'Student Updated Successfully');
    }
    public function destroystudent(Student $student)
    {
        $student->delete();
        return redirect(route('gotoAdminStudent'))->with('success', 'A student Deleted Successfully');
    }

    public function destroyteacher(Teacher $teacher)
    {
        $teacher->delete();
        return redirect(route('gotoAdminTeacher'))->with('success', 'teacher Deleted Successfully');
    }

    public function destroycourse(Course $course)
    {
        $course->delete();
        return redirect(route('gotoAdminCourse'))->with('success', 'Course Deleted Successfully');
    }
    public function destroycoursedist(Distribution $cdistribution)
    {
        
        $cdistribution->delete();
        return redirect(route('gotoAdminCourseDist'))->with('success', 'Course Distribution Deleted Successfully');
    }

    public function gotoTeacherDashboard()
    {
        $user = Session::get('curr_user');
        $user_email = $user->email;
        //dd($user_email);
        $courses = Distribution::where('teacher', $user_email)->get();
        $cs = Course::all();
        //dd($courses);
        return view('teachers.teacherDashboard', [
            'courses' => $courses,
            'cs' => $cs,
        ]);
    }

    public function gotoStudentDashboard()
    {
        $user = Session::get('curr_user');

        $cs = Course::all();

        $routines = ClassRoutine::where('degree', $user->degree)
            ->where('level', $user->level)
            ->where('semester', $user->semester)
            ->where('session', $user->session)
            ->get();

        $courses = Course::where('degree', $user->degree)
            ->where('level', $user->level)
            ->where('semester', $user->semester)
            ->get();

        //dd($routines);
        // Check if routines are retrieved correctly
        if ($routines->isEmpty()) {
            // Handle the case where no routines are found
            return view('students.studentDashboard', [
                'routines' => collect(), // Pass an empty collection if no routines found
                'message' => 'No class routines found for your selection.',
            ]);
        }

        return view('students.studentDashboard', [
            'routines' => $routines,
            'user' => $user,
            'courses' => $courses,
            'cs' => $cs,
        ]);
    }
}
