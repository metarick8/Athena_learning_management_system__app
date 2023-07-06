<?php

namespace App\Http\Controllers;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function addVideo(Request $request){
        $video =Video::create([
            'title' => $request->title,
            'duration' => $request->duration,
            'path' => $request->path,
            'module_id'=>1,
        ]);
        return response()->json([
            "massage"=>"Video has been added Sucsessfully!",
        ]);
    }
    public function showVideo($id){
        $video =Video::where("video_id",$id)->first();
        return response()->json([
            "course"=>$video
        ]);
    }
}
