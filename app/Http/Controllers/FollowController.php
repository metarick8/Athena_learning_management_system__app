<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow($id){
        $user_id=Auth::id();
        $tutor=Tutor::where("tutor_id",$id)->first();
        $tutor_id=$tutor['tutor_id'];
        Follow::create([
        'user_id'=>$user_id,
        'tutor_id'=>$tutor_id,
        ])->save();
        $followed=User::where("user_id",$tutor->user_id)
        ->first(["first_name","last_name"]);
        return response()->json([
            "massage"=>"Congrats!,you started to follow : Bro ".$followed['first_name']." ".$followed['last_name'],
        ]);
    }
}
