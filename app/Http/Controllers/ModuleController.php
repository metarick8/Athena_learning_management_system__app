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
        return response()->json([
            "massage"=>"Module has been added Sucsessfully!",
        ]);
    }
    public function showModule($id){
        $module =Module::where("module_id",$id)->first();
        return response()->json([
            "course"=>$module
        ]);
    }

}
