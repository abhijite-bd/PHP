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


class DashboardController extends Controller
{

    public function gotoAdminDashboard()
    {
        return view('admins.adminDashboard');
    }
    public function gotoStudentResult(Request $request)
    {
        $user = Session::get('curr_user');
        $user_email = $user->email;
        $s_id = DB::table('students')
            ->where('email', $user_email)
            ->value('s_id');
        $courses = Course::all();

        // Get the CGPA data for this student
        // $cgpa = Cgpa::find($s_id);
        // dd($cgpa);

        return view('students.resultpage', compact('s_id', 'cgpa', 'courses'));
    }

    public function gotoAdminStudentDashboard(Request $request)
    {
        // Start with a base query
        $query = Student::query();

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
        // Start with a base query for the Teacher model
        $query = Teacher::query();

        // Apply department filter if it exists in the request
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // Apply designation filter if it exists in the request
        if ($request->filled('designation')) {
            $query->where('designation', $request->designation);
        }

        // Execute the query and get the filtered results
        $teachers = $query->get();

        // Return the view with the filtered teacher list
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
            'faculties' => ['Computer Science and Engineering', 'Agriculture', 'Engineering'],
            'departments' => ['CSE', 'EEE', 'ECE'],
            'designations' => ['Lecturer', 'Assistant Professor', 'Associate Professor', 'Professor'],
        ]);
    }
    public function updatestudent(Student $student, Request $request)
    {
        // $data = $request->validate([
        //     's_id' => 'required',
        //     'name' => 'required',
        //     'degree' => 'required',
        //     'level' => 'required',  
        //     'semester' => 'required',  
        //     'session' => 'required',
        //     'email' => 'required|email',  
        //     'password' => 'required',
        // ]);
        // if ($request->filled('password')) {
        //     $data['password'] = bcrypt($request->password);
        // } else {
        //     unset($data['password']);
        // }
        dd($student);
        // $student->update(($data));
        // return redirect(route('gotoAdminStudent'))->with('success', 'Student Updated Successfully');
    }
    public function destroystudent(Student $student)
    {
        $student->delete();
        return redirect(route('gotoAdminStudent'))->with('success', 'A student Deleted Successfully');
    }

    public function destroyteacher(Teacher $teacher)
    {
        $teacher->delete();
        return redirect(route('gotoAdminTeacher'))->with('success', 'teacher Deleted Successfully');
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
        //dd($user_email);
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

        // Get distributions where the user's email matches
        // $distributions = DB::table('distributions')
        //     ->where('teacher', $email)
        //     ->get();
        $courses = DB::table('courses')->get(['code', 'name']);

        $currentDate = now()->toDateString();

        $scheduledCourses = DB::table('courses_schedule')
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
        $request->validate([
            'course_code' => 'required|string',
            'date' => 'required|date',
            'day' => 'required|string',
            'time' => 'required|date_format:H:i',
        ]);

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
        // Find the scheduled course by ID
        $schedule = Course_Schedule::findOrFail($id);

        // Delete the course
        $schedule->delete();

        // Redirect back with a success message
        return redirect()->route('gotoTeacherClassSchedule')->with('success', 'Course removed successfully.');
    }
    public function gotoStudentClassSchedule()
    {
        $user = Session::get('curr_user');
        $id = $user->id;

        //     // Find the student by ID
        //     $student = Student::findOrFail($id);
        //     $courses = Course::all();
        //     if ($courses->isEmpty()) {
        //         return "No courses found.";
        //     }

        //     // Get the first course
        //     $studentLevel = $student->level;
        //     $studentSemester = $student->semester;

        //     // Retrieve courses that match the student's level and semester
        //     $course = Course::where('level', $studentLevel)
        //         ->where('semester', $studentSemester)
        //         ->get();

        //     // Fetch schedules for the course
        //     $schedules = Course_Schedule::where('course_code', $course->code)->get();

        //     // Check if schedules were found
        //     if ($schedules->isEmpty()) {
        //         return "No schedules found for course code: {$course->code}";
        //     }
        $student = Student::findOrFail($id);
        $studentLevel = $student->level;
        $studentSemester = $student->semester;
        // dd($student);
        // Use a join to fetch courses and their schedules based on student level and semester
        $schedules = Course_Schedule::join('courses', 'courses_schedule.course_code', '=', 'courses.code')
            ->where('courses.level', $studentLevel)
            ->where('courses.semester', $studentSemester)
            ->select('courses_schedule.*', 'courses.name as course_name')
            ->get();

        // Check if any schedules were found
        // if ($schedules->isEmpty()) {
        //     return "No schedules found for the student's level and semester.";
        // }

        // // Return or display the schedules
        // return $schedules;
        return view('students.studentcoursesschedule', compact('schedules'));
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

        //dd($routines);
        // Check if routines are retrieved correctly
        if ($routines->isEmpty()) {
            // Handle the case where no routines are found
            return view('students.studentDashboard', [
                'routines' => collect(), // Pass an empty collection if no routines found
                'message' => 'No class routines found for your selection.',
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
