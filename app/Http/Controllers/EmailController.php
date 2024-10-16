<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClassRoutine;
use App\Models\Student;
use App\Models\Course_Schedule;
use App\Mail\StudentReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    public function sendEmailsToAllStudents(Course_Schedule $course_Schedule)
    {
        $user = Session::get('curr_user');

        $subject = "Reminder for Upcoming Classes";
        $body = "no body";
        $students = Student::all();
        // dd($student);
        // foreach ($students as $student) {
        //     Mail::to($student->email)->send(new StudentReminderMail($subject, $body));
        // }

        return back()->with('success', 'Emails sent successfully!');
    }
}
