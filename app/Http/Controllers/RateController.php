<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Rate;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    public function addRate(Request $request,$id){
        $user_id=Auth::id();
        $Subscription=Subscription::where('user_id',$user_id)->where('course_id',$id);
        if($Subscription==null){
            return response()->json([
                "Sorry"=>"you Don't authorized to Rate anyone !",
            ]);
        }
        else{
        Rate::create([
            'subscription_id' => $Subscription->subscription_id,
            'user_id'=>$user_id,
            'course_id'=>$id,
            'rate' => $request->rate,
        ]);
    }
    }
    public function getRate($id){
    $course=Course::find($id);
    $course_id=$course->course_id;
    $ratings=Rate::where('course_id',$course_id)->sum('rate');
    $ratings_num=Rate::where('course_id',$course_id)->count();
    $final=$ratings/(float)$ratings_num;
    return response()->json([
        "final_Rate"=>$final,
    ]);

    }

}
