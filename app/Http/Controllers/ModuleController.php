<?php

namespace App\Http\Controllers;
use App\Models\Module;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function addModule(Request $request,$id){
        // $course_id=Auth::id();
        $module =Module::create([
            'title' => $request->title,
            'path' => $request->path,
            'total_videos'=>5,
            'has_quiz'=>true,
            'course_id' =>$id,
        ]);
        return response()->json([
            "massage"=>"Module has been added Sucsessfully!",
        ]);
    }
    public function addQuizz(Request $request,$id){
        $module=Module::where('module_id',$id)->get();
        if($module->has_quiz==1){
            Quiz::create([
            'module_id' => $module->module_id,
            'quiz'=>$request->quiz,
            'quiz_duration'=>$request->quiz_duration,
            ]);
            return response()->json([
                "massage"=>"OK!",
            ]);
        }
        else{
            return response()->json([
                "massage"=>"you Cant!",
            ]);
        }

    }
    public function showModule($id){
        $module =Module::where("module_id",$id)->first();
        return response()->json([
            "massage"=>$module
        ]);
    }

}
