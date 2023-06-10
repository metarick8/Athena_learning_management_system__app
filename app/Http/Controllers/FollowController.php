<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(Request $request,$id){
        $user_id=Auth::id();
        Follow::create([
        'user_id'=>$user_id,
        'tutor_id'=>$id,
        ]);
    }
}
