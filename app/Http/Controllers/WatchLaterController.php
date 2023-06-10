<?php

namespace App\Http\Controllers;
use App\Models\Watch_later;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchLaterController extends Controller
{
    public function watch_later(Request $request,$id){
        $user_id=Auth::id();
        Watch_later::create([
        'user_id'=>$user_id,
        'course_id'=>$id,
        ]);
    }
    public function getWatch(){
        $user_id=Auth::id();
        $whatch=Watch_later::where('user_id',$user_id);
        return response()->json([
            "hello"=>"your courses list"+$whatch,
        ]);
    }
}
