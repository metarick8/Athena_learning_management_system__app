<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Tutor;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
// just random commit
    public function addCourse(Request $request){
        $user_id = Auth::id();
        $tutor = Tutor::where('user_id', $user_id)->first();
        if ($tutor)
           $tutor_id = $tutor->tutor_id;
        $course =Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => intVal($request->price),
            'level' => $request->level,
            'tutor_id'=> $tutor_id,
            'category_id'=> intval($request->category_id),
            'total_modules' => intval($request->totalModules)
        ]);
        $input = json_decode($request->modules);
        $index = 0; // the index represents the key name from front-end as the key of each video being send
        foreach ($input as $module) {
            $createdModule = $course->modules()->create([
                'title' => $module->title,
                'description' => $module->description,
            ]);

            foreach ($module->videos as $video) {
                $createdVideo = $createdModule->videos()->create([
                    'title' => $video->title,
                    'path' => 'path',
                    'duration' => $video->duration
                ]);
            $storingVideo = $request->file(strval($index));
            $image_name =  $createdVideo->video_id .'.'. $storingVideo->getClientOriginalExtension();
            $path = $storingVideo->storeAs('Tutors/'. $tutor->tutor_id . '/Courses/'. $course->course_id . '/Modules/' . $createdModule->module_id, $image_name);
            $createdVideo->path = $path;
            $createdVideo->save();
            $index++;
            }
        }

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $image_name =  'cover.'. $image->getClientOriginalExtension();
            $path = $image->storeAs('Tutors/'. $tutor->tutor_id . '/Courses/'. $course->course_id, $image_name);
            $course->cover_path = $path;
            $course->save();
        }
        return $course;
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
            default:    return response()->json([
                "message"=>"No Results"
            ]);
        }
    }


}
