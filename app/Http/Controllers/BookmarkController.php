<?php

namespace App\Http\Controllers;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BookmarkController extends Controller
{
    public function bookmark(Request $request,$id){
        $user_id=Auth::id();
        Bookmark::create([
        'user_id'=>$user_id,
        'video_id'=>$id,
        'title'=>$request->title,
        'duration'=>$request->duration,
        ]);
    }
    public function getbookmarks(){
        $user_id=Auth::id();
        $bookmarks=Bookmark::where('user_id',$user_id);
        return response()->json([
            "hello"=>"your courses list"+$bookmarks,
        ]);
    }
}
