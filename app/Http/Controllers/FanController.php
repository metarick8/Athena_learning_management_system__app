<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Fan;
use Illuminate\Http\Request;

class FanController extends Controller
{
    public function is_fan($user_id,$tutor_id){
        $fan=Fan::where('user_id',$user_id)->where('tutor_id',$tutor_id);
        if($fan){
            return true;
        }
        else{
            return false;
        }
    }
    // public function is_fan($user_id,$tutor_id){
    //     $fan=Fan::where('user_id',$user_id)->where('tutor_id',$tutor_id);
    //     return $fan;
    // }
}
