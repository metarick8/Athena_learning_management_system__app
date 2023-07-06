<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Watch_later;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchLaterController extends Controller
{
    public function watch_later($id)
    {
        $user_id = Auth::id();
        $course = Course::where("course_id", $id)->first();
        Watch_later::create([
            'user_id' => $user_id,
            'course_id' => $course->course_id,
        ])->save();
        return response()->json([
            "massage" => "you just add a course to the wish list",
        ]);
    }
    public function getWatch()
    {
        try{
        $user_id = Auth::id();
        //join
        /*
        $Courses=Course::join('watch_later','courses.course_id','=','watch_later.course_id')->where('watch_later.user_id', $user_id)->get([
            "title",
            "description",
            "price",
            "level",
            "total_course_duration",
            "total_modules"
        ]);
        return response()->json([
            "Wish List" => $Courses,
        ]);
        */
        //normal
        $watch = Watch_later::where('user_id', $user_id)->get('course_id');
        $courses = array();
        for ($i = 0; $i < count($watch); $i++) {
            $courses[$i] = Course::where('course_id', $watch[$i]['course_id'])->first([
                "title",
                "description",
                "price",
                "level",
                "total_course_duration",
                "total_modules"
            ]);
        }
        return response()->json([
            "Wish List" => $courses,
        ]);
    }
        catch(Exception $e){
            return response()->json([
                "Wish List" => $e,
            ],500);
        }
    }
}
