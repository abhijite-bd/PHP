<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $courseName;
    public $courseCode;
    public $date;
    public $time;
    public $day;
    public $add;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($courseName, $courseCode, $date, $time, $day, $add)
    {
        $this->courseName = $courseName;
        $this->courseCode = $courseCode;
        $this->date = $date;
        $this->time = $time;
        $this->day = $day;
        $this->add = $add;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->add == 1) {
            return $this->view('student_remainder_add')
                ->subject("Class Has Been Cancelled")
                ->with([
                    'courseName' => $this->courseName,
                    'courseCode' => $this->courseCode,
                    'date' => $this->date,
                    'time' => $this->time,
                    'day' => $this->day,
                ]);
        } else {
            return $this->view('student_reminder_cancel')
                ->subject("Class Has Been Cancelled")
                ->with([
                    'courseName' => $this->courseName,
                    'courseCode' => $this->courseCode,
                    'date' => $this->date,
                    'time' => $this->time,
                    'day' => $this->day,
                ]);
        }
    }
}
