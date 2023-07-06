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
class SubscriptionController extends Controller
{
    public function subscripe(Request $request){
        $user_id=Auth::id();
        $user=User::where("user_id",$user_id)->get();
        $course=course::where("course_id",$request->course_id)->get();
        $tutor = User::where("user_id",Tutor::where("tutor_id",$course->tutor_id)->get()->user_id)->get();
        $fan=new FanController();
        $is_fan=$fan->is_fan($user_id,$course->tutor_id);
        $price= $course->price;
        $courses=Course::where('tutor_id',$course->tutor_id);
        $Subscriptions=Subscription::where('user_id',$user_id)->where('course_id',$courses->course_id);
        if($Subscriptions->count()>5){
        Fan::create([
            'user_id'=>$user_id,
            'tutor_id'=>$course->tutor_id,
        ])->save();
        }
        if($is_fan==true)
                $price=0.2*$course->price;
        if($user->budget < $price)
        {
            return response()->json([
                "sorry"=>"you Don't have enough money!",
            ]);
        }
        Subscription::create([
            'user_id' => $user_id,
            'course_id'=> $request->course_id ,
        ]);
        $user->budget =  $user->budget - $price;
        $tutor->budget =  $tutor->budget + $price;
        return response()->json([
                "Done"=>"your just Subscribed and you have to pay"+ $price,
            ]);
    }

}
// else{
//     $courses=Course::where('tutor_id',$course->tutor_id);
//     foreach($cours as $courses)
//     $Subscriptions=Subscription::where('user_id',$user_id)->where('course_id',$cours->course_id);
//     if($Subscriptions->count()>5)
//         Fan::create([
//             'user_id'=>$user_id,
//             'tutor_id'=>$course->tutor_id,
//         ])->save();
// }
