<?php

namespace App\Http\Controllers;

use App\Models\Subscription_for_private;
use App\Models\User;
use App\Models\Private_course;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionForPrivateController extends Controller
{
    public function Private_subscripe($id){
        // $user_id=Auth::id();
        $user_id=2;
        $user=User::where("user_id",$user_id)->first();
        $Private_course=Private_course::where("private_course_id",$id)->first();
        $tutor = User::where("user_id",Tutor::where("tutor_id",$Private_course->tutor_id)->first()->user_id)->first();
        $price= $Private_course->price;
        if($user->budget < $price)
        {
            return response()->json([
                "massage"=>"Sorry! you Don't have enough Money to join this class!",
            ]);
        }
        Subscription_for_private::create([
            'user_id' => $user_id,
            'private_course_id'=> $id ,
        ]);
        $user->budget =  $user->budget - $price;
        $user ->save();
        $tutor->budget =  $tutor->budget + $price;
        $tutor ->save();
        return response()->json([
                "massage"=>"Congrats! your just Subscribed this private Course and you have to pay " . $price,
            ]);
    }
}
