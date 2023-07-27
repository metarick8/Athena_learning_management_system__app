<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Tutor;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    use Response;
    public function getCourses(){

        //$courses=Course::all();
        $courses = Course::with('modules.videos')->get();
        if($courses==[]){
            return response()->json([
                "message"=>"no courses"
            ]);
        }


        return $this->success([
            'message' => $courses
        ]);
    }
    public function addCourse(Request $request){
        $user_id = Auth::id();
        $tutor = Tutor::where('user_id', $user_id)->first();
        if ($tutor)
           $tutor_id = $tutor->tutor_id;
        for ($i=1; $i <= $request->number ; $i++) {
            //$request->get($i);
            $video = $request->file($i);
            $idPathName = $video->getClientOriginalName();
            $idPathName= 'module1   '
            $parts = explode("|", $string); // Split the string into an array using the "|" delimiter
            $filename = explode(".", $parts[1])[0]; // Split the second part of the array using the "." delimiter and get the first element
            $idPathName = 'module10';
            return $result = Str::after($idPathName, 'module');
            $idPath = $video->storeAs('public/Tutors/'. $tutor_id . '/Courses', $idPathName);
        }
        /*$string = "module10|title.jphg";
        $parts = explode("|", $string); // Split the string into an array using the "|" delimiter
        $filename = explode(".", $parts[1])[0]; // Split the second part of the array using the "." delimiter and get the first element

echo $filename; // Output: "title"*/
        /*
        $user_id = Auth::id();
        $tutor = Tutor::where('user_id', $user_id)->first();
        if ($tutor)
           $tutor_id = $tutor->tutor_id;

        $course =Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'level' => $request->level,
            'tutor_id'=> $tutor_id,
            'category_id'=>$request->category_id,
        ]);

        foreach ($request->modules as $module) {
            $createdModule = $course->modules()->create([
                'title' => $module['title'],
                'description' => $module['descri\ption'],
            ]);

            foreach ($module['videos'] as $video) {
                $createdModule->videos()->create([
                    'title' => $video['title'],
                    'path' => 'path',
                    'duration' => $video['duration']
                ]);
            }
        }

        $course = Course::with('modules.videos')->where('course_id', $course->course_id)->get();
        return $course;*/
    }

    /*public function deleteCourse($id){
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
    }*/

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
            default:    return response()->json([
                "message"=>"No Results"
            ]);
        }
    }


}
