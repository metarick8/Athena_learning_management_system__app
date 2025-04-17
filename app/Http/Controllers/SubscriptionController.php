<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Course;
use App\Models\Tutor;
use App\Models\Fan;
use App\Http\Controllers\FanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
class SubscriptionController extends Controller
{
    public function subscripe($id){
        // $user_id=Auth::id();
        $user_id=2;
        $user=User::where("user_id",$user_id)->first();
        $course=course::where("course_id",$id)->first();
        $tutor = User::where("user_id",Tutor::where("tutor_id",$course->tutor_id)->first()->user_id)->first();
        $price= $course->price;
        //all user subs at that same tutor courses
        $Subscriptions=Subscription::join('courses','courses.course_id','=','subscriptions.course_id')
        ->where('subscriptions.user_id', $user_id)->get();
        if($Subscriptions->count()>3){
        Fan::create([
            'user_id'=>$user_id,
            'tutor_id'=>$course->tutor_id,
        ])->save();
        }
        $fan=new FanController();
        $is_fan=$fan->is_fan($user_id,$course->tutor_id);
        if($is_fan==true)
                $price=$price - 0.25*$course->price;
        if($user->budget < $price)
        {
            return response()->json([
                "massage"=>"Sorry! you Don't have enough money!",
            ]);
        }
        Subscription::create([
            'user_id' => $user_id,
            'course_id'=> $id ,
        ])->save();
        $user->budget =  $user->budget - $price;
        $user->save();
        $tutor->budget =  $tutor->budget + $price;
        $tutor->save();
        return response()->json([
                "massage"=>"your just Subscribed and you have to pay ". $price,
            ]);
        }

    }
