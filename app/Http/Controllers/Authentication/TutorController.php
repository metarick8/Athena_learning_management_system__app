<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Resources\TutorResource;
use App\Http\Resources\UserResource;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\Response;

class TutorController extends Controller
{
    use Response;

    public function register(Request $request)
    {
       // $request->validated();

        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'picture' => $request->picture,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_tutor' => true

        ]);
        Tutor::create([
            'user_id' => $user->id,
            'bio' => $request->bio,
            'rate' => 0,
            'id_photo' => 'path',
            'certification' => 'path',
            'c_v' => 'path',
        ]);

        $tutor = User::with('tutor')->find($user->id);
        return response()->json([
            'tutor' => new TutorResource($tutor),
            'token' => $tutor->createToken('API Token of ' . $tutor->name)->accessToken
        ]);
     }

}
