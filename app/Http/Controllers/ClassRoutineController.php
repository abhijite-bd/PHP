<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\ClassRoutine;

class ClassRoutineController extends Controller
{

    public function uploadPage(Request $request){
        return view('classRoutine.classRoutine' , [
            'degrees' => ['B.Sc. in CSE', 'B.Sc. in ECE', 'B.Sc. in EEE'],
        ]);
    }

    public function upload(Request $request)
    {
        $routineData = $request->input('routine');

        foreach ($routineData as $day => $slots) {
            foreach ($slots as $time => $className) {
                if ($className) {
                    ClassRoutine::create([                        
                        'degree' => $request->degree,
                        'level' => $request->level,
                        'semester' => $request->semester,
                        'session' => $request->session,
                        'weekday' => $this->getWeekday($day),
                        'time_slot' => $this->getTimeSlot($time),
                        'class_name' => $className,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Class routine uploaded successfully!');
    }

    private function getWeekday($day)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        return $days[$day - 1];
    }

    private function getTimeSlot($hour)
    {
        $startTime = date('g:i A', strtotime($hour . ':00'));
        $endTime = date('g:i A', strtotime(($hour + 1.5) . ':30'));
        return "$startTime - $endTime";
    }
}
