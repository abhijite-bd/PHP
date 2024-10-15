<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\StudentReminderMail;
class Course_Schedule extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'courses_schedule';

    // Define the fillable attributes
    protected $fillable = [
        'course_code',
        'date',
        'day',
        'time',
    ];
    public static function checkAndSendClassNotifications()
    {
        // Get current date and time
        $now = now();

        // Retrieve classes that are starting in 10 minutes or less
        $upcomingClasses = self::where('date', $now->toDateString())
            ->whereTime('time', '>=', $now->toTimeString())
            ->whereTime('time', '<=', $now->addMinutes(10)->toTimeString())
            ->get();

        foreach ($upcomingClasses as $class) {
            // Retrieve all students
            $students = \App\Models\Student::all();

            foreach ($students as $student) {
                // Send notification email to each student
                Mail::to($student->email)->queue(new StudentReminderMail($class));
            }
        }
    }
}
