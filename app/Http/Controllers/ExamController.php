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
use App\Models\Exam;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\StudentCgpaValidation;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function gotoTeachersExamPage()
    {
        $exams = Exam::all();
        return view('teachers.gotoTeachersExamPage', compact('exams'));
    }
    public function examcreate()
    {
        $user = Session::get('curr_user');
        $teacher_name = $user->name;
        $userEmail = $user->email;

        // Get course codes based on the user's email from the distributions table
        $distributions = Distribution::where('teacher', $userEmail)->pluck('course')->toArray();

        // Get course names based on course codes
        $courses = Course::whereIn('code', $distributions)->pluck('name', 'code');

        return view('teachers.create_exam', [
            'courseCodes' => $distributions,
            'courseNames' => $courses,
            'teacher_name' => $teacher_name
        ]);
    }
    public function examstore(Request $request)
    {
        // dd($request);
        $request->validate([
            'course_code' => 'required',
            'course_name' => 'required',
            'teacher' => 'required',
            'type' => 'required|array',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i', // Validate time format (24-hour)
        ]);

        Exam::create([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'teacher' => $request->teacher,
            'type' => implode(',', $request->type), // Convert array to string
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('gotoTeachersExamPage')->with('success', 'Exam added successfully.');
    }
    public function examdestroy($id)
    {
        // dd($id);
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->route('gotoTeachersExamPage')->with('success', 'Exam deleted successfully!');
    }
    public function gotoTeachersExamPagefilter(Request $request)
    {
        $query = Exam::query();
        // dd($query->get());
        // Filtering by course code
        if ($request->has('course_code') && $request->course_code != '') {
            $query->where('course_code', 'LIKE', '%' . $request->course_code . '%');
        }

        // Filtering by course name
        if ($request->has('course_name') && $request->course_name != '') {
            $query->where('course_name', 'LIKE', '%' . $request->course_name . '%');
        }

        // Filtering by exam status
        if ($request->has('status') && $request->status != '') {
            $today = now();
            if ($request->status == 'upcoming') {
                $query->where('date', '>=', $today);
            } elseif ($request->status == 'previous') {
                $query->where('date', '<', $today);
            }
        }

        $exams = $query->get();

        return view('teachers.gotoTeachersExamPage', compact('exams'));
    }
    public function viewexam(Request $request)
    {
        $user = Session::get('curr_user');

        // Get courses based on user degree, level, and semester
        $courses = Course::where('degree', $user->degree)
            ->where('level', $user->level)
            ->where('semester', $user->semester)
            ->pluck('code');

        // Initialize the query for exams
        $query = Exam::whereIn('course_code', $courses);

        // Apply filters based on the request
        if ($request->filled('course_code')) {
            $query->where('course_code', 'like', '%' . $request->course_code . '%');
        }

        if ($request->filled('course_name')) {
            $query->where('course_name', 'like', '%' . $request->course_name . '%');
        }

        if ($request->filled('exam_type')) {
            $today = now();
            if ($request->exam_type == 'upcoming') {
                $query->where('date', '>', $today);
            } elseif ($request->exam_type == 'previous') {
                $query->where('date', '<=', $today);
            }
        }

        // Get the filtered exams
        $exams = $query->get();

        return view('students.viewexam', compact('exams'));
    }
}
