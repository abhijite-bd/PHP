<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Distribution;
use App\Models\StudentMaterial;
use App\Models\Teacher;
use App\Models\Material;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class StudentMaterialController extends Controller
{
    public function gotoUploadMaterialByStudentPage()
    {
        $user = Session::get('curr_user');
        $materials = StudentMaterial::where('s_id', $user->s_id)->get();
        //$assignments = Assignment::where('course_code', $code)->where('session', $session)->get();
        return view('materials.addMaterialByStudent' , [
            'materials' => $materials, 
        ]);
    }

    public function addStudentMaterial(Request $request)
    {
        $user = Session::get('curr_user');
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $materialFilePath = $this->uploadFile($request, 'file', 'public/materialFile');

        try {
            StudentMaterial::create([
                's_id' => $user->s_id,
                'title' => $request->title,
                'description' => $request->description,
                'file' => $materialFilePath,
            ]);
            //return redirect()->back()->with('success', 'Material Added!')->with('active_tab', 'material');
            notify()->success('Material uploaded!');
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

    

    public function editStudentMaterial(Request $request, $id)
    {
        //dd('HI');
        $material = \App\Models\StudentMaterial::findOrFail($id);
        //dd($material->title);
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
            return redirect()->back()->with('success', 'Material Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
