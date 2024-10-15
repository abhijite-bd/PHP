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
use App\Models\cgpa;
use App\Models\Course_Schedule;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\StudentCgpaValidation;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassReminder;


class ReminderController extends Controller
{
    public function saveReminder(Request $request)
    {
        $user = Session::get('curr_user');

        // Check if the reminder toggle is on or off
        if ($request->has('reminder_time')) {
            $request->validate([
                'reminder_time' => 'required|integer|min:1',
            ]);

            // Save or update the reminder
            ClassReminder::updateOrCreate(
                ['student_id' => $user->s_id],
                ['reminder_time' => $request->reminder_time]
            );

            return back()->with('success', 'Reminder set successfully!');
        } else {
            // Delete the reminder if it exists
            ClassReminder::where('student_id', $user->s_id)->delete();
            return back()->with('success', 'Reminder deleted successfully!');
        }
    }

    // New method to handle deletion request
    public function deleteReminder(Request $request)
    {
        $user = Session::get('curr_user');

        // Delete the reminder if it exists
        ClassReminder::where('student_id', $user->s_id)->delete();
        return back()->with('success', 'Reminder deleted successfully!');
    }
}
