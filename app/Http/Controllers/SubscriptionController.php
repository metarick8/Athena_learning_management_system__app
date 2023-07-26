<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Course;
use App\Models\Tutor;
use App\Models\Fan;
use App\Http\Controllers\FanController;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    use Response;
    public function subscribe(Request $request){
        $user_id=Auth::id();
        $user=User::where("id",$user_id)->first();
        $course=course::where("course_id",$request->course_id)->first();
        $tutor = Tutor::where('tutor_id', $course->tutor_id)->first();
        $tutorAsUser = User::where("id",$tutor->user_id)->first();
        $fan = new FanController();
        $is_fan = $fan->is_fan($user_id,$course->tutor_id);
        $price = $course->price;
        if($is_fan){
            $price *= 0.2;
            if($user->budget>$price){
                Subscription::create([
                    'user_id' => $user_id,
                    'course_id'=> $request->course_id ,
                ]);
                $user->budget = $user->budget - $price;
                $tutor->budget = $user->budget + $price;
                return $this->success([
                    'message' => 'successfully subscribed as a fan',
                    'is_fan' => true
                ]);
            }
            return $this->error('', 'Amount isn\'t enough',401);
        }
        if($user->budget>$price){
            Subscription::create([
                'user_id' => $user_id,
                'course_id'=> $request->course_id ,
            ]);
            $user->budget = $user->budget - $price;
            $tutorAsUser->budget = $user->budget + $price;
            $count = DB::table('subscriptions')
                ->join('courses', 'subscriptions.course_id', '=', 'courses.course_id')
                ->where('subscriptions.user_id', $user_id)
                ->where('courses.tutor_id', $course->tutor_id)
                ->count();
            if ($count==5){
                Fan::create([
                    'user_id'=>$user_id,
                    'tutor_id'=>$course->tutor_id,
                ]);
                return $this->success([
                    'message' => ' sunscrived and became a fan',
                    'become_a_fan' => true,
                ]);
            }
            return $this->success([
                'message' => 'subscribed successfully',
                'to_be_fan' => 5 - $count
            ]);
        }
        return $this->error('', 'Amount isn\'t enough', 401);
    }
}
/*

            $courses=Course::where('tutor_id',$course->tutor_id)->get();
            $Subscriptions=Subscription::where('user_id',$user_id)->where('course_id',$courses->course_id);
            if($Subscriptions->count()==5){
                Fan::create([
                    'user_id'=>$user_id,
                    'tutor_id'=>$course->tutor_id,
                ]);
                        }
    }

}*/
