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
use Illuminate\Support\Facades\Http;
use App\Mail\StudentReminderMail;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function gotoTeacherProfile()
    {
        return view('teachers.gotoTeacherProfile');
    }

    public function gotoAdminDashboard()
    {
        return view('admins.adminDashboard');
    }
    public function gotoStudentResult(Request $request)
    {
        return view('students.resultpage');
    }
    public function cgpastore(Request $request)
    {
        $user = Session::get('curr_user');
        $s_id = $user->s_id;
        // dd($id);
        // Only save the CGPA fields that have values
        $data = $request->only(['l1s1', 'l1s2', 'l2s1', 'l2s2', 'l3s1', 'l3s2', 'l4s1', 'l4s2']);
        $data['s_id'] = $s_id;

        // Save or update the CGPA data for the user
        Cgpa::updateOrCreate(
            ['s_id' => $s_id],
            $data
        );
        return redirect()->route('cgpa.form')->with('success', 'CGPA data saved successfully!');
    }
    public function validateCgpareq(Request $request)
    {
        $user = Session::get('curr_user');
        $s_id = $user->s_id;

        // Update the 'valid' field when validated
        Cgpa::where('s_id', $s_id)->update([
            'valid' => 1
        ]);

        return response()->json(['message' => 'CGPA validated successfully.']);
    }
    public function saveCgpa(Request $request)
    {
        // Iterate over levels and semesters
        foreach ($request->input('cgpa') as $level => $semesters) {
            foreach ($semesters as $semester => $cgpaValue) {
                $creditValue = $request->input('credit')[$level][$semester] ?? 0;
                $isValid = isset($request->input('validate')[$level][$semester]) ? 1 : 0;

                // Save to student_cgpa_validation table
                $cgpaValidation = new StudentCgpaValidation();
                $cgpaValidation->s_id = $request->s_id; // Assuming you pass this in your request
                $cgpaValidation->level = $level;
                $cgpaValidation->semester = $semester;
                $cgpaValidation->cgpa = $cgpaValue;
                $cgpaValidation->done = 0; // Set done to 0
                $cgpaValidation->save();

                // Save to cgpa table with valid status
                $cgpa = new Cgpa(); // Replace with your actual CGPA model
                $cgpa->s_id = $request->s_id; // Assuming you pass this in your request
                $cgpa->{'l' . $level . 's' . $semester} = $cgpaValue; // Dynamically set the field
                $cgpa->valid = $isValid; // Set valid status
                $cgpa->save();
            }
        }

        return redirect()->back()->with('success', 'CGPA data saved successfully!');
    }

    public function resultValidation(Request $request)
    {
        // Filter conditions
        $query = Cgpa::select('cgpas.*', 'students.name', 'students.level', 'students.semester')
            ->join('students', 'cgpas.s_id', '=', 'students.s_id');

        // Apply filters based on request inputs
        if ($request->filled('s_id')) {
            $query->where('cgpas.s_id', $request->s_id);
        }

        if ($request->filled('level')) {
            $query->where('students.level', $request->level);
        }

        if ($request->filled('semester')) {
            $query->where('students.semester', $request->semester);
        }
        $mergedData = $query->where('valid', 0)->get();

        return view('admins.resultValidation', compact('mergedData'));
    }
    public function validationReq()
    {
        $mergedData = Cgpa::select('cgpas.*', 'students.name', 'students.level', 'students.semester')
            ->join('students', 'cgpas.s_id', '=', 'students.s_id')
            ->get();

        return view('admins.resultValidation', compact('mergedData'));
    }
    public function editCgpa($id)
    {

        $cgpa = CGPA::where('id', $id)->first();

        $credits = [19.00, 19.25, 21.5, 20, 18.5, 18.5, 18.75, 19.25];
        $weightedSum = 0;
        $totalCredits = 0;
        if ($cgpa) {

            for ($i = 1; $i <= 8; $i++) {
                $semCgpa = $cgpa->{'sem' . $i};

                if ($semCgpa !== null) {
                    $weightedSum += $semCgpa * $credits[$i - 1];

                    $totalCredits += $credits[$i - 1];
                }
            }
        }
        $result = $totalCredits > 0 ? $weightedSum / $totalCredits : null;

        // dd($cgpa);
        return view('admins.cgpa_form', ['cgpa' => $cgpa, 'credits' => $credits, 'result' => $result]);
    }
    public function saveResult($id, CGPA $cgpa, Request $request)
    {
        dd($id);
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

        $cgpa = CGPA::where('s_id', $id)->first();

        if ($cgpa) {
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
                's_id' => $id,
                'sem1' => $request->input('sem1'),
                'sem2' => $request->input('sem2'),
                'sem3' => $request->input('sem3'),
                'sem4' => $request->input('sem4'),
                'sem5' => $request->input('sem5'),
                'sem6' => $request->input('sem6'),
                'sem7' => $request->input('sem7'),
                'sem8' => $request->input('sem8'),
                'valid' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'CGPA record saved successfully!');
    }


    public function deleteCgpa($id)
    {
        $cgpa = Cgpa::findOrFail($id);
        $cgpa->delete();

        return redirect()->route('resultValidation')->with('success', 'CGPA deleted successfully.');
    }



    public function gotoAdminStudentDashboard(Request $request)
    {
        // Start with a base query
        $query = Student::query();
        if ($request->filled('id')) {
            $query->where('s_id', $request->id);
        }
        // Check if 'level' is present in the request and not empty
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Check if 'semester' is present in the request and not empty
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        // Get the filtered result
        $students = $query->get();

        // Return the view with the filtered student list
        return view('admins.adminStudentDashboard', ['students' => $students]);
    }


    public function gotoAdminTeacherDashboard(Request $request)
    {
        // dd($request);
        $query = Teacher::query();

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('designation')) {
            $query->where('designation', $request->designation);
        }
        $teacherName = $request->input('teacher_name');
        if ($request->filled('teacher_name')) {
            $query->where('name', 'like', "%$teacherName%");
        }

        $teachers = $query->get();

        return view('admins.adminTeacherDashboard', ['teachers' => $teachers]);
    }

    public function gotoAdminCourseDistDashboard(Request $request)
    {
        // Get the filter values from the request
        $courseCode = $request->input('course_code');
        $courseName = $request->input('course_name');
        $teacherName = $request->input('teacher_name');

        // Build the query with optional filters
        $query = DB::table('distributions')
            ->join('courses', 'distributions.course', '=', 'courses.code')
            ->join('teachers', 'distributions.teacher', '=', 'teachers.email')
            ->select(
                'distributions.course AS course_code',
                'courses.name',
                'teachers.name AS teacher_name',
                'distributions.session'
            );

        // Apply filters if they are set
        if ($courseCode) {
            $query->where('distributions.course', 'like', "%$courseCode%");
        }
        if ($courseName) {
            $query->where('courses.name', 'like', "%$courseName%");
        }
        if ($teacherName) {
            $query->where('teachers.name', 'like', "%$teacherName%");
        }

        $cdistributions = $query->get();

        return view('admins.adminCourseDistDashboard', ['cdistributions' => $cdistributions]);
    }

    public function gotoAdminCourseDashboard(Request $request)
    {
        // Start with a base query for Course model
        $query = Course::query();

        // Apply filters if they exist in the request
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        if ($request->filled('credit_hour')) {
            $query->where('credit_hour', $request->credit_hour);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Execute the query and get the filtered results
        $courses = $query->get();

        // Return the view with the filtered course list
        return view('admins.adminCourseDashboard', ['courses' => $courses]);
    }


    public function editstudent(Student $student)
    {
        // dd($student);
        return view('admins.studentedit', ['student' => $student]);
    }
    public function editteacher(Teacher $teacher)
    {
        // dd($student);
        return view('admins.teacheredit', [
            'teacher' => $teacher,
            'faculties' => ['Computer Science and Engineering'],
            'departments' => [
                1 => 'CSE',
                2 => 'EEE',
                3 => 'ECE',
            ],
            'designations' => ['Lecturer', 'Assistant Professor', 'Associate Professor', 'Professor'],
        ]);
    }
    public function updateTeacher(Teacher $teacher, Request $request)
    {
        $data = $request->input();
        $teacher->update(($data));
        $teacher->faculty = 1;
        $teacher->save();
        return redirect(route('gotoAdminTeacher'))->with('success', 'Teacher Updated Successfully');
    }
    public function updatestudent(Student $student, Request $request)
    {
        $data = $request->input();
        // dd($data);
        $student->update(($data));
        $student->password = bcrypt($request->input('password'));
        $student->save();
        return redirect(route('gotoAdminStudent'))->with('success', 'Student Updated Successfully');
    }
    public function destroystudent(Student $student)
    {
        $student->delete();
        return redirect(route('gotoAdminStudent'))->with('success', 'A student Deleted Successfully');
    }

    public function destroyteacher(Teacher $teacher)
    {
        $teacher->delete();
        return redirect(route('gotoAdminTeacher'))->with('success', 'Teacher Deleted Successfully');
    }

    public function destroycourse(Course $course)
    {
        $course->delete();
        return redirect(route('gotoAdminCourse'))->with('success', 'Course Deleted Successfully');
    }
    public function destroycoursedist(Distribution $cdistribution)
    {

        $cdistribution->delete();
        return redirect(route('gotoAdminCourseDist'))->with('success', 'Course Distribution Deleted Successfully');
    }

    public function gotoTeacherDashboard()
    {
        $user = Session::get('curr_user');
        $user_email = $user->email;
        // dd($user_email);
        $courses = Distribution::where('teacher', $user_email)->get();
        $cs = Course::all();
        //dd($courses);
        return view('teachers.teacherDashboard', [
            'courses' => $courses,
            'cs' => $cs,
        ]);
    }
    public function gotoTeacherClassSchedule()
    {
        $user = Session::get('curr_user');
        $email = $user->email;
        $courses = DB::table('courses')->get(['code', 'name']);
        $currentDate = now()->toDateString();

        $matchedCourses = DB::table('distributions')
            ->where('teacher', $email) // Assuming 'teacher' is the column name for emails
            ->pluck('course'); // This retrieves a collection of course codes

        $scheduledCourses = DB::table('courses_schedule')
            ->whereIn('course_code', $matchedCourses->toArray()) // Use whereIn with the matched courses
            ->join('courses', 'courses_schedule.course_code', '=', 'courses.code')
            ->select('courses_schedule.id', 'courses_schedule.date', 'courses_schedule.day', 'courses_schedule.time', 'courses_schedule.course_code', 'courses.name as course_name')
            ->where('courses_schedule.date', '>=', $currentDate)
            ->get();
        // Pass data to the view
        $distributions = DB::table('distributions')
            ->join('courses', 'distributions.course', '=', 'courses.code')
            ->leftJoin('courses_schedule', 'distributions.course', '=', 'courses_schedule.course_code')
            ->select('distributions.course', 'courses.name as course_name', DB::raw('MAX(courses_schedule.date) as last_date'), DB::raw('GROUP_CONCAT(courses_schedule.time SEPARATOR ", ") as times'))
            ->where('distributions.teacher', $email)
            ->groupBy('distributions.course', 'courses.name')
            ->get();
        return view('teachers.classschedule', compact('distributions', 'scheduledCourses', 'courses'));
    }
    public function gotoTeacherClassScheduleStore(Request $request)
    {
        // Validate form input
        $validatedData = $request->validate([
            'course_code' => 'required|string',
            'date' => 'required|date',
            'day' => 'required|string',
            'time' => 'required|date_format:H:i',
        ]);
        $course = Course::where('code', $request->course_code)->first();
        $level = $course->level;
        $semester = $course->semester;
        $students = Student::where('level', $level)
            ->where('semester', $semester)
            ->get();
        // dd($students);
        $subject = "Reminder for Upcoming Classes";

        $courseName = $course->name;
        $courseCode = $validatedData['course_code'];
        $date = $validatedData['date'];
        $time = $validatedData['time'];
        $day = $validatedData['day'];
        foreach ($students as $student) {
            Mail::to($student->email)->send(new StudentReminderMail($courseName, $courseCode, $date, $time, $day,1));
        }
        // Save the class schedule (assuming a `class_schedules` table exists)
        DB::table('courses_schedule')->insert([
            'course_code' => $request->course_code,
            'date' => $request->date,
            'day' => $request->day,
            'time' => $request->time,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Class schedule saved successfully!');
    }
    public function courses_schedule_destroy($id)
    {
        $schedule = Course_Schedule::findOrFail($id);

        $course = Course::where('code', $schedule->course_code)->first();
        $level = $course->level;
        $semester = $course->semester;
        $students = Student::where('level', $level)
            ->where('semester', $semester)
            ->get();
        $subject = "CLass Has Been Cancelled";

        $courseName = $course->name;
        $courseCode = $schedule->course_code;
        $date = $schedule->date;
        $time = $schedule->time;
        $day = $schedule->day;
        foreach ($students as $student) {
            Mail::to($student->email)->send(new StudentReminderMail($courseName, $courseCode, $date, $time, $day,0));
        }

        $schedule->delete();

        return redirect()->route('gotoTeacherClassSchedule')->with('success', 'Course removed successfully.');
    }

    public function gotoStudentClassSchedule()
    {
        $user = Session::get('curr_user');
        $id = $user->id;

        $student = Student::findOrFail($id);
        $studentLevel = $student->level;
        $studentSemester = $student->semester;
        // dd($user);
        $currentDate = now()->toDateString();
        $schedules = Course_Schedule::join('courses', 'courses_schedule.course_code', '=', 'courses.code')
            ->where('courses.level', $studentLevel)
            ->where('courses.semester', $studentSemester)
            ->select('courses_schedule.*', 'courses.name as course_name')
            ->where('courses_schedule.date', '>=', $currentDate)
            ->get();
        $reminder = ClassReminder::where('student_id', $user->s_id)->first();

        return view('students.studentcoursesschedule', compact('user', 'schedules', 'reminder'));
    }


    public function gotoStudentDashboard()
    {
        $user = Session::get('curr_user');
        $cs = Course::all();

        $routines = ClassRoutine::where('degree', $user->degree)
            ->where('level', $user->level)
            ->where('semester', $user->semester)
            ->where('session', $user->session)
            ->get();

        $courses = Course::where('degree', $user->degree)
            ->where('level', $user->level)
            ->where('semester', $user->semester)
            ->get();
        if ($routines->isEmpty()) {
            return view('students.studentDashboard', [
                'user' => $user,
                'courses' => $courses,
                'cs' => $cs,
                'routines' => collect(), // Pass an empty collection if no routines found
                'message' => 'No class routines found for your selection.',
                'reminder' => null,
            ]);
        }
        return view('students.studentDashboard', [
            'routines' => $routines,
            'user' => $user,
            'courses' => $courses,
            'cs' => $cs,
        ]);
    }
}
