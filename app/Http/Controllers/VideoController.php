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
    }
    public function showVideo($id){
        $video =Video::find($id);
        return response()->json([
            "course"=>$video
        ]);
    }
}
