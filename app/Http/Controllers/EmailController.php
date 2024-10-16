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
        dd($user);

        $subject = "Reminder for Upcoming Classes";

        // Loop through each student and send the email
        foreach ($students as $student) {
            Mail::to($student->email)->send(new StudentReminderMail($subject));
        }

        return back()->with('success', 'Emails sent successfully!');
    }
}
