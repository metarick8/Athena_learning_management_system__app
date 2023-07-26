<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Models\Tutor;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    use Response;
    public function follow($id){
        $user_id=Auth::id();
        Follow::create([
        'user_id'=>$user_id,
        'tutor_id'=>$id,
        ]);
        return $this->success([
            'message' => 'Followed successfully',
        ]);
    }
    public function unfollow($id){
        $user_id = Auth::id();
        $follow = Follow::where('user_id', $user_id)->where('tutor_id', $id)->first();
        if($follow!=null){
        $follow->delete();
        return $this->success([
            'message' => "unfollowed successfuly"
        ]);}
        return $this->error('','User didn\'t follow the tutor yet', 401);
    }
    public function getFollowers(){
        $user_id = Auth::id();
        return Follow::where('user_id', $user_id)->get();
    }
}
