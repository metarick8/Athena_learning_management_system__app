<?php

namespace App\Http\Controllers;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function addModule(Request $request){
        // $course_id=Auth::id();
        $module =Module::create([
            'title' => $request->title,
            'path' => $request->path,
            'total_videos'=>5,
            'has_quiz'=>true,
            'course_id' =>2,
        ]);
    }
    public function showModule(Request $request,$id){
        $module =Module::find($id);
        return response()->json([
            "course"=>$module
        ]);
    }

}
