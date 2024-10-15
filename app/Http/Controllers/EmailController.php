<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClassRoutine;
use App\Models\Student;
use App\Mail\StudentReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    public function sendEmailsToAllStudents()
    {
        $user = Session::get('curr_user');
        $level = $user->level;
        $semester = $user->semester;
        $students = Student::where('level', $level)
            ->where('semester', $semester)
            ->get();
        // dd($students);
        $subject = "Reminder for Upcoming Classes";

        // Loop through each student and send the email
        foreach ($students as $student) {
            Mail::to($student->email)->send(new StudentReminderMail($subject));
        }

        return back()->with('success', 'Emails sent successfully!');
    }
}
