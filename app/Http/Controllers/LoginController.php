<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;

class LoginController extends Controller
{
    public function gotoAdminLoginPage()
    {
        return view('logins.adminLoginPage');
    }

    public function gotoTeacherLoginPage()
    {
        return view('logins.teacherLoginPage');
    }

    public function gotoStudentLoginPage()
    {
        return view('logins.studentLoginPage');
    }

    public function loginAdmin(Request $request)
    {
        $user = Admin::where('email', $request->get('email'))->first();

        if ($user == null) {
            return redirect()->back()->with('error', 'email does not exist');
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            return redirect()->back()->with('error', 'Wrong Password');
        }

        \Illuminate\Support\Facades\Session::put('curr_user', $user);

        $user_role = $user->role;
        $user_id = $user->id;

        \Illuminate\Support\Facades\Session::put('user_role', $user_role);
        \Illuminate\Support\Facades\Session::put('user_id', $user_id);

        //return redirect()->route('gotoAdminDashboard');

        //return redirect('/')->with('error', 'You do not have access to this page.');

        if ($user_role == 'Admin') {
            return redirect()->route('gotoAdminDashboard');
        }
        else if ($user_role == 'Teacher') {
            return redirect()->route('gotoTeacherDashboard');
        }
        else if ($user_role == 'Student') {
            return redirect()->route('gotoStudentDashboard');
        }

        return redirect('/')->with('error', 'Please Login First!');

        
    }

    public function loginStudent(Request $request)
    {
        $user = Student::where('email', $request->get('email'))->first();

        if ($user == null) {
            return redirect()->back()->with('error', 'email does not exist');
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            return redirect()->back()->with('error', 'Wrong Password');
        }

        \Illuminate\Support\Facades\Session::put('curr_user', $user);

        $user_role = $user->role;
        $user_id = $user->id;

        \Illuminate\Support\Facades\Session::put('user_role', $user_role);
        \Illuminate\Support\Facades\Session::put('user_id', $user_id);

        return redirect()->route('gotoStudentDashboard');

        //return redirect('/')->with('error', 'You do not have access to this page.');

        
    }

    public function loginTeacher(Request $request)
    {
        $user = Teacher::where('email', $request->get('email'))->first();

        if ($user == null) {
            return redirect()->back()->with('error', 'email does not exist');
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            return redirect()->back()->with('error', 'Wrong Password');
        }

        \Illuminate\Support\Facades\Session::put('curr_user', $user);

        $user_role = $user->role;
        $user_id = $user->id;

        \Illuminate\Support\Facades\Session::put('user_role', $user_role);
        \Illuminate\Support\Facades\Session::put('user_id', $user_id);

        return redirect()->route('gotoTeacherDashboard');

        //return redirect('/')->with('error', 'You do not have access to this page.');

        
    }

    public function logout()
    {
        \Illuminate\Support\Facades\Session::forget('curr_user');
        \Illuminate\Support\Facades\Session::forget('user_role');
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
