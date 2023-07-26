<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Course;
use App\Models\Watch_later;
use App\Traits\Response;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchLaterController extends Controller
{
    use Response;
    public function watch_later($id)
    {
        $user_id = Auth::id();
        $course = Course::where("course_id", $id)->first();
        Watch_later::create([
            'user_id' => $user_id,
            'course_id' => $course->course_id,
        ]);
        return $this->success([
            'message' => 'Course added to wishlist'
        ]);
    }
    public function getWatch()
    {
        $user_id = Auth::id();
        $wishlist = Watch_later::where('user_id', $user_id)->get();
        return $wishlist;
    }
}
