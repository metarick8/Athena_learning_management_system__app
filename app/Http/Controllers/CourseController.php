<?php

namespace App\Http\Controllers;
use App\Models\Course;
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
            'category_id'=>1,
            'total_course_duration'=> '11:11:11',
            'total_modules' => 3,
        ]);
        $course->save();
        echo 'hi';
        return response()->json([
            "course"=> $course->course_id,
        ]);
    }
    public function deleteCourse($id){
        $course=Course::find($id);
        $course->delete();
        $course->save();
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
    public function findCourse($id){
        switch($id){
            //category
            case 1:{
                $course=Course::find($id);
                return response()->json([
                    "course"=>$course
                ]);
            }
            break;
            //tutor
            case 2:{
                $course=Course::find($id);
                return response()->json([
                    "course"=>$course
                ]);
            }
            break;
            //top rating
            case 3:{
                $course=Course::find($id);
                return response()->json([
                    "course"=>$course
                ]);
            }
            break;
            default:return response()->json([
                "message"=>"No Results"
            ]);
        }
    }


}
