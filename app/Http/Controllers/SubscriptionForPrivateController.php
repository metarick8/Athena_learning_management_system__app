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
    public function Private_subscripe(Request $request){
        $user_id=Auth::id();
        $user=User::find($user_id);
        $Private_course=Private_course::find($request->private_course_id);
        $tutor = User::find(Tutor::find($Private_course->tutor_id)->user_id);
        $price= $Private_course->price;
        $Private_courses=Private_course::where('tutor_id',$Private_course->tutor_id);
        if($user->budget < $price)
        {
            return response()->json([
                "sorry"=>"you Can't have this class!",
            ]);
        }
        Subscription_for_private::create([
            'user_id' => $user_id,
            'private_course_id'=> $request->course_id ,
        ]);
        $user->budget =  $user->budget - $price;
        $tutor->budget =  $tutor->budget + $price;
        return response()->json([
                "Done"=>"your just Subscribed and you have to pay"+ $price,
            ]);
    }
}
