<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgressionCourseController extends Controller
{
    public function perVideo(Request $request){
        return response()->json([
            "massage"=>"Module has been added Sucsessfully!",
        ]);
    }
    public function perModule(Request $request){
        return response()->json([
            "massage"=>"Module has been added Sucsessfully!",
        ]);
    }
}
