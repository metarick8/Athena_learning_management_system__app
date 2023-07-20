<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function getCourses(){

        $courses=Course::all();
        if($courses==[]){
            return response()->json([
                "message"=>"no courses"
            ]);
        }
        return response()->json([
            "courses"=>$courses
        ]);
    }
    public function addCourse(Request $request){
        $tutor_id=Auth::id();
        $course =Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'level' => $request->level,
            'tutor_id'=> 2,
            'category_id'=>2,
            'total_course_duration'=> '11:11:11',
            'total_modules' => 3,
        ]);
        $course->save();
        return response()->json([
            "course"=> $course,
        ]);
    }
    public function deleteCourse($id){
        $course=Course::where("course_id",$id);
        $course->delete();
        return response()->json([
            "course"=>"done baby ",
        ]);
    }
    public function showCourse($id){
        $course=Course::find($id);
        return response()->json([
            "course"=>$course
        ]);
    }
    public function findCourse(Request $request,$id){
        switch($id){
            //category -> id=1
            case 1:{
                $courses=Course::where("category_id",$request->category)->get();
                return response()->json([
                    "course"=>$courses
                ]);
            }
            break;
            //tutor -> id=2
            case 2:{
                $courses=Course::where("tutor_id",$request->tutor)->get();
                return response()->json([
                    "course"=>$courses
                ]);
            }
            break;
            default:return response()->json([
                "message"=>"No Results"
            ]);
        }
    }


}
