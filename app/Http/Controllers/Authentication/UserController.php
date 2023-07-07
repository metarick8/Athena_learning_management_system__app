<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
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
            'user' => $user,
            'token' => $user->createToken('authToken')->accessToken
        ]);

// $token = $user->createToken('My Token');

// // Get the access token result object
// $tokenResult = $token->accessToken;

// // Get the access token string
// $accessToken = $tokenResult->token;

// // Use the access token string
// return $accessToken;
     }
}
