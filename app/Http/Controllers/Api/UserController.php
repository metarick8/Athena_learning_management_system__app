<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Authentication\UserRegisterRequest;
use App\Http\Requests\Api\Authentication\LoginRequest;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $request->validated($request->all());
        $user = User::create([
            'username' => $request->username,
            // 'yooo',
            'first_name' => $request->first_name,
            // 'testing',
            'last_name' => $request->last_name,
            // 'testing',
            'picture' => $request->picture,
            //$request->picture,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            // '120385713',
        ]);
        $token = $user->createToken('Token')->accessToken;
        return response()->json(['Token' => $token, 'user'=>$user], 200);
    }
    public function login(LoginRequest $request)
    {
        $request->validated($request->all());
        if(!auth()->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return  response()->json('Credentials do not match', 401);
        }
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('Token')->accessToken;
        return response()->json(['Token' => $token, 'user'=>$user], 200);
    }
    
}
