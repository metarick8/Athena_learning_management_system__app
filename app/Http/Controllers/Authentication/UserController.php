<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\UserRegisterRequest;
use App\Models\User;
use App\Traits\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Resources\TutorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
            'password' => Hash::make($request->password)

        ]);
        /*$token =$user->createToken('API Token of' . $user->name)->plainTextToken;
        dd($token);
        //return response()->json(['user' => $user]);
        use Laravel\Passport\PersonalAccessTokenResult;*/
        //return response()->json(['user' => $user]);
// Create a new access token
        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('API Token of ' . $user->name)->accessToken
        ]);

// $token = $user->createToken('My Token');

// // Get the access token result object
// $tokenResult = $token->accessToken;

// // Get the access token string
// $accessToken = $tokenResult->token;

// // Use the access token string
// return $accessToken;
     }

    public function login(Request $request)
    {
        //$request->validated($request->all());
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return  $this->error('','Credentials do not match', 401);
        $user = User::where('email', $request->email)->first();

        /*
        if($user->is_tutor)
            return $this->success([
                'tutor' => new TutorResource($user),
                'token' => $user->createToken('API Token of ' . $user->name)->accessToken
            ]);*/
        return $this->success([
            'user' => new UserResource($user),
            'token' => $user->createToken('API Token of ' . $user->name)->accessToken
        ]);
    }
}
