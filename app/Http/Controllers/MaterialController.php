<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Distribution;
use App\Models\Teacher;
use App\Models\Material;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class MaterialController extends Controller
{
    public function gotoUploadMaterialByTeacherPage($code, $session)
    {
        $course = Course::where('code', $code)->first();
        $materials = Material::where('course_code', $code)->where('session', $session)->get();
        //$assignments = Assignment::where('course_code', $code)->where('session', $session)->get();
        return view('materials.addMaterialByTeacher' , [
            'course' => $course,
            'session' => $session, 
            'materials' => $materials, 
        ]);
    }

    public function addMaterial(Request $request, $course_code, $session)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $materialFilePath = $this->uploadFile($request, 'file', 'public/materialFile');

        try {
            Material::create([
                'course_code' => $course_code,
                'session' => $session,
                'title' => $request->title,
                'description' => $request->description,
                'file' => $materialFilePath,
            ]);
            //return redirect()->back()->with('success', 'Material Added!')->with('active_tab', 'material');
            notify()->success('File Uploaded Successfully!');
            return redirect()->back()->with('success', 'Material Added!')->with('activeTab', 'material-tab');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('active_tab', 'material');
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

    public function downloadMaterial($id)
    {
        // Find the material by ID
        $material = \App\Models\Material::findOrFail($id);
        $filePath = $material->file;

        // Construct the full file path within the storage/app/public/materialFile directory
        $fullFilePath = storage_path('app/public/materialFile/' . basename($filePath));

        // Check if the file exists and return it for download
        if (file_exists($fullFilePath)) {
            return response()->download($fullFilePath);
        } else {
            return abort(404, 'File not found');
        }
    }

    public function editMaterialPage($id)
    {
        $material = \App\Models\Material::findOrFail($id);
        return view('materials.editMaterialPage', [
            'material' => $material,
        ]);
    }

    public function editMaterial(Request $request, $id)
    {
        $material = \App\Models\Material::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        //file ta niye kaj ache

        $materialFilePath = $material->file;
        
        if($request->file)
        {
            $materialFilePath = $this->uploadFile($request, 'file', 'public/materialFile');
        }
        //$materialFilePath = $this->uploadFile($request, 'file', 'public/materialFile');

        try {
            $material->update([
                'title' => $request->title,
                'description' => $request->description,
                'file' => $materialFilePath,
            ]);
            return redirect()->back()->with('message', 'Material Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
