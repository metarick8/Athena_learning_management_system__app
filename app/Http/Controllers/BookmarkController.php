<?php

namespace App\Http\Controllers;
use App\Models\Bookmark;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BookmarkController extends Controller
{
    public function bookmark(Request $request,$id){
        $user_id=Auth::id();
        $video=Video::where("video_id",$id)->first();
        Bookmark::create([
        'user_id'=>$user_id,
        'video_id'=>$video->video_id,
        'title'=>$request->title,
        'duration'=>$request->duration,
        ])->save();
        return response()->json([
            "massage"=>"you just add a bookmark "."in the duration".$request->duration,
        ]);
    }
    public function getbookmarks(){
        $user_id=Auth::id();
        $bookmarks=Bookmark::where('user_id',$user_id)->get();
        return response()->json([
            "massage"=>$bookmarks,
        ]);
    }
}
