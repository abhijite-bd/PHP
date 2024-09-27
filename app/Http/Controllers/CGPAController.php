<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CGPA;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Distribution;
use App\Models\Course;
use App\Models\ClassRoutine;
use Illuminate\Support\Facades\Session;
use App\Models\Faculty;
use App\Models\Course_Schedule;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\StudentCgpaValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CGPAController extends Controller
{
    public function saveResult(CGPA $cgpa, Request $request)
    {
        // Validate the request data
        $request->validate([
            'valid' => 'nullable|boolean',
            'sem1' => 'nullable|numeric|min:0|max:4.00',
            'sem2' => 'nullable|numeric|min:0|max:4.00',
            'sem3' => 'nullable|numeric|min:0|max:4.00',
            'sem4' => 'nullable|numeric|min:0|max:4.00',
            'sem5' => 'nullable|numeric|min:0|max:4.00',
            'sem6' => 'nullable|numeric|min:0|max:4.00',
            'sem7' => 'nullable|numeric|min:0|max:4.00',
            'sem8' => 'nullable|numeric|min:0|max:4.00',
        ]);
        $user = Session::get('curr_user');
        $s_id = $user->s_id;
        // Find the CGPA record for the student ID, or create a new one if it doesn't exist
        $cgpa = CGPA::where('s_id', $s_id)->first();

        if ($cgpa) {
            // dd($cgpa);
            // If CGPA exists, update it
            $cgpa->{'sem1'} = $request->input('sem1');
            $cgpa->{'sem2'} = $request->input('sem2');
            $cgpa->{'sem3'} = $request->input('sem3');
            $cgpa->{'sem4'} = $request->input('sem4');
            $cgpa->{'sem5'} = $request->input('sem5');
            $cgpa->{'sem6'} = $request->input('sem6');
            $cgpa->{'sem7'} = $request->input('sem7');
            $cgpa->{'sem8'} = $request->input('sem8');
            $cgpa->valid = 0;
            $cgpa->save();  // Save the updated CGPA
        } else {
            CGPA::create([
                's_id' => $s_id,
                'sem1' => $request->input('sem1'),
                'sem2' => $request->input('sem2'),
                'sem3' => $request->input('sem3'),
                'sem4' => $request->input('sem4'),
                'sem5' => $request->input('sem5'),
                'sem6' => $request->input('sem6'),
                'sem7' => $request->input('sem7'),
                'sem8' => $request->input('sem8'),
                'valid' => $request->input('valid'),
            ]);
        }

        return redirect()->back()->with('success', 'CGPA record saved successfully!');
    }


    public function gotoResult()
    {
        $user = Session::get('curr_user');
        $s_id = $user->s_id;
        $cgpa = CGPA::where('s_id', $s_id)->first();

        // dd($cgpa);
        $credits = [19.00, 19.25, 21.5, 20, 18.5, 18.5, 18.75, 19.25];
        $weightedSum = 0;
        $totalCredits = 0;

        // Loop through each semester and calculate only for filled CGPA fields
        for ($i = 1; $i <= 8; $i++) {
            $semCgpa = $cgpa->{'sem' . $i}; // Get CGPA for the semester

            if ($semCgpa !== null) {
                // Add to the weighted sum: CGPA * Credits
                $weightedSum += $semCgpa * $credits[$i - 1];

                // Sum up the credits only for filled CGPA fields
                $totalCredits += $credits[$i - 1];
            }
        }
        $result = $totalCredits > 0 ? $weightedSum / $totalCredits : null;

        return view('students.cgpa_form', ['cgpa' => $cgpa, 'credits' => $credits, 'result' => $result]);
    }
    // public function fetchCourses(Request $request)
    // {
    //     dd($request);
    //     // $semester = $request->get('semester');
    //     // $level = $request->get('level');
    //     // $degree = $request->get('degree');
    //     // dd($request);

    //     // // Fetch the courses from the `courses` table that match the degree, level, and semester
    //     // $courses = Course::where('degree', $degree)
    //     //     ->where('level', $level)
    //     //     ->where('semester', $semester)
    //     //     ->get();

    //     // return response()->json(['courses' => $courses]);
    // }
    public function fetchCourses(Request $request)
    {
        dd($request);
        try {
            $semester = $request->get('semester');
            $level = $request->get('level');
            $degree = 'B.Sc. in CSE'; // Use the constant degree string

            // Log the incoming request data for debugging
            Log::info('Fetch courses request data', ['semester' => $semester, 'level' => $level, 'degree' => $degree]);

            // Fetch courses based on semester, level, and degree
            $courses = Course::where('degree', $degree)
                ->where('level', $level)
                ->where('semester', $semester)
                ->get();

            // Return the list of courses as JSON
            return response()->json(['courses' => $courses], 200);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error fetching courses: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'Failed to fetch courses'], 500);
        }
    }
}
