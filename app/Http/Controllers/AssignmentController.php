<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Distribution;
use App\Models\Teacher;
use App\Models\Material;
use App\Models\Assignment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{    
    public function gotoUploadAssignmentByTeacherPage($code, $session)
    {
        $course = Course::where('code', $code)->first();
        //$materials = Material::where('course_code', $code)->where('session', $session)->get();
        $assignments = Assignment::where('course_code', $code)->where('session', $session)->get();
        return view('assignments.addAssignmentByTeacher' , [
            'course' => $course,
            'session' => $session, 
            'assignments' => $assignments, 
        ]);
    }

    public function addAssignment(Request $request, $course_code, $session)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date_format:m/d/Y',
        ]);

        $deadline = \DateTime::createFromFormat('m/d/Y', $request->deadline)->format('Y-m-d');
        $materialFilePath = $this->uploadFile($request, 'file', 'public/assignmentFile');

        try {
            Assignment::create([
                'course_code' => $course_code,
                'session' => $session,
                'title' => $request->title,
                'description' => $request->description,
                'file' => $materialFilePath,
                'deadline' => $deadline,
            ]);
            //return redirect()->back()->with('success', 'Assignment Added!')->with('active_tab', 'assignment');
            return redirect()->back()->with('success', 'Assignment Added!')->with('activeTab', 'assignment-tab');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('active_tab', 'assignment');
        }
    }


    private function uploadFile(Request $request, string $fileKey, string $directory): string
    {
        if ($request->hasFile($fileKey)) {
            $fileName = $request->title . '_' . $request->file($fileKey)->getClientOriginalName();
            $filePath = $request->file($fileKey)->storeAs($directory, $fileName);
            return str_replace('public/', '', $filePath);
        }
        else
        {
            return '';
        }

        //throw new \Exception('File not present in request.');
    }

    public function downloadAssignment($id)
    {
        // Find the assignment by ID
        $assignment = \App\Models\Assignment::findOrFail($id);
        $filePath = $assignment->file;

        // Construct the full file path within the storage/app/public/materialFile directory
        $fullFilePath = storage_path('app/public/assignmentFile/' . basename($filePath));

        // Check if the file exists and return it for download
        if (file_exists($fullFilePath)) {
            return response()->download($fullFilePath);
        } else {
            return abort(404, 'File not found');
        }
    }

    public function editAssignmentPage($id)
    {
        $assignment = \App\Models\Assignment::findOrFail($id);
        return view('assignments.editAssignmentPage', [
            'assignment' => $assignment,
        ]);
    }

    public function editAssignment(Request $request, $id)
    {
        $assignment = \App\Models\Assignment::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required',
        ]);
        //file ta niye kaj ache

        $assignmentFilePath = $assignment->file;
        
        if($request->file)
        {
            $assignmentFilePath = $this->uploadFile($request, 'file', 'public/assignmentFile');
        }
        //$materialFilePath = $this->uploadFile($request, 'file', 'public/materialFile');

        try {
            $assignment->update([
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'file' => $assignmentFilePath,
            ]);
            return redirect()->back()->with('success', 'Assignment Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    
}
