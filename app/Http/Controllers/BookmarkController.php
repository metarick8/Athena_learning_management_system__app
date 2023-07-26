<?php

namespace App\Http\Controllers;
use App\Models\Bookmark;
use App\Models\Video;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BookmarkController extends Controller
{
    use Response;
    public function addBookmark(Request $request){
        $user_id=Auth::id();
        Bookmark::create([
        'user_id' => $user_id,
        'video_id' => $request->video_id,
        'title' => $request->title,
        'duration' => $request->duration,
        ]);

        return $this->success([
            'message' => 'Bookmark added successfully'
        ]);
    }

    public function getBookmarks(){
        $user_id=Auth::id();
        $bookmarks=Bookmark::where('user_id',$user_id)->get();
        return $this->success([
            'Bookmarks' => $bookmarks,
        ]);
    }

    public function deleteBookmark(Request $request){
        $user_id = Auth::id();

        Bookmark::where('user_id', $user_id)->where('video_id', $request->video_id)->first()->delete();
        return $this->success([
            'message' => 'Bookmark deleted successfully'
        ]);
    }
}
