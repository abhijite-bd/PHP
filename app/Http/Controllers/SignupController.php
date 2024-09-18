<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Department;

class SignupController extends Controller
{
    public function gotoSignupChoicePage()
    {
        return view('signups.signupChoice');
    }

    public function gotoStudentSignupPage()
    {
        return view('signups.studentSignupPage' , [
            'degrees' => ['B.Sc. in CSE', 'B.Sc. in ECE', 'B.Sc. in EEE'],
        ]);
    }

    public function gotoAdminSignupPage()
    {
        return view('signups.adminSignupPage');
    }

    public function gotoTeacherSignupPage()
    {
        $faculties = Faculty::all();
        $departments = Department::all();
        return view('signups.teacherSignupPage' , [
            'faculties' => $faculties,
            'departments' => $departments,
            'designations' => ['Lecturer', 'Assistant Professor', 'Associate Professor', 'Professor'],
        ]);
    }

    public function signupStudent(Request $request)
    {
        $request->validate([
            's_id' => 'required',
            'name' => 'required',
            'level' => 'required',
            'semester' => 'required',
            'session' => 'required',
            'degree' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        try {

            $student = Student::create([
                's_id' => $request->s_id,
                'name' => $request->name,
                'level' => $request->level,
                'semester' => $request->semester,
                'session' => $request->session,
                'degree' => $request->degree,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'Student',
            ]);

            return redirect()->back()->with('success', "Student added successfully!");
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function signupAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        try {

            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'Admin',
            ]);

            return redirect()->back()->with('success', "Admin added successfully!");
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function signupTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'department' => 'required',
            'faculty' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        try {

            $teacher = Teacher::create([
                'name' => $request->name,
                'department' => $request->department,
                'faculty' => $request->faculty,
                'designation' => $request->designation,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'Teacher',
            ]);

            return redirect()->back()->with('success', "Teacher added successfully!");
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
