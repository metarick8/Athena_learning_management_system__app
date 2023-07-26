<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Rate;
use App\Models\Subscription;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    use Response;
    public function addRate(Request $request){
        $user_id=Auth::id();
        $Subscription=Subscription::where([
            ['user_id', $user_id],
            ['course_id', $request->course_id]
        ])->first();

        if($Subscription==[])
            return $this->error('','Not subscribed to rate this course', 401);
        Rate::create([
            'user_id'=>$user_id,
            'course_id'=>$request->course_id,
            'rate' => $request->rate,
            'opinion' => $request->opinion
        ]);
        $course = Course::where('course_id', $request->coruse_id)->first();
        if ($course->rate == 0)
            $course->rate = $request->rate;
        $course->rate += $request->rate /2;
        return $this->success([
            'message' => 'Rate added'
        ]);
    }

    public function getRate($id){
        $rates=Rate::where('course_id',$id)->sum('rate');
        $rate_count=Rate::where('course_id',$id)->count();
        $rate=$rates/(float)$rate_count;
        return $this->success([
            'rate' => $rate
        ]);
    }

}
