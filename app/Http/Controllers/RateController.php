<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Rate;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    public function addRate(Request $request,$id){
        $user_id=Auth::id();
        $Subscription=Subscription::where([
            ['user_id', '=', $user_id],
            ['course_id', '=', $id]
        ])
        ->first();
        if($Subscription==[]){
            return response()->json([
                "massage"=>"Sorry!..you Don't authorized to Rate anyone !",
            ]);
        }
        else{
            Rate::create([
                'user_id'=>$user_id,
                'course_id'=>$id,
                'rate' => $request->rate,
            ])->save();
            return response()->json([
                "massage"=>"Thanks For ur rating!",
            ]);
    }
    }
    public function addComment(Request $request,$id){
        // $user_id=Auth::id();
        $user_id=4;
        $Subscription=Subscription::where([
            ['user_id', '=', $user_id],
            ['course_id', '=', $id]
        ])
        ->first();
        if($Subscription==[]){
            return response()->json([
                "massage"=>"Sorry!..you Don't authorized to Comment!",
            ]);
        }
        else{
            Rate::create([
                'user_id'=>$user_id,
                'course_id'=>$id,
                'opinion' => $request->opinion,
            ])->save();
            return response()->json([
                "massage"=>"Thanks For ur Comment!",
            ]);
    }
    }
    public function getRate($id){
    $course=Course::where('course_id',$id)->first();
    $course_id=$course->course_id;
    $ratings=Rate::where('course_id',$course_id)->sum('rate');
    $ratings_num=Rate::where('course_id',$course_id)->count();
    $final=$ratings/(float)$ratings_num;
    return response()->json([
        "massage"=>"Final Rate".$final,
    ]);
    }

    public function getComments($id){
        //comments with the user who write it ditals.
        $Comments=User::join('rates','users.user_id','=','rates.user_id')
        ->where('rates.course_id', $id)->whereNotNull('opinion')->get([
            "first_name",
            "last_name",
            "opinion",
        ]);
        return response()->json([
            "Wish List" => $Comments,
        ]);
        }


}
