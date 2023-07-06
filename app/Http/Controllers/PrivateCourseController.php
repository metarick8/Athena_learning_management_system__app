<?php

namespace App\Http\Controllers;
use App\Models\Private_course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PrivateCourseController extends Controller
{
    public function add_Private_Course(Request $request){
        $tutor_id=Auth::id();
        $Private_course =Private_course::create([
            'tutor_id'=> 2,
            'title' => $request->title,
            'price' => $request->price,
            'appointment' => $request->appointment,
            'description' => $request->description,
            'finished'=>$request->finished,
        ]);
        $Private_course->save();
    }
}
