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
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use Response;
    public function __invoke()
    {
        Storage::makeDirectory('Public/Users');
        Storage::makeDirectory('public/Tutors');

    }

    public function register(Request $request)
    {
       // $request->validated();
        if(User::count()==0){
            $makeDirectories = new UserController();
            $makeDirectories->__invoke();
        }

        $path = '';
        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'picture' => $path,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_tutor' => false

        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name =$user->id . $image->getClientOriginalName();
            $path = $image->storeAs('Public/Users', $image_name);
            $user->picture = $path;
        }
        /*$user->sendEmailVerificationNotification();
        return response()->json(['message' => 'Registration successful. Please check your email for verification.']);*/
        /*$token =$user->createToken('API Token of' . $user->name)->plainTextToken;
        dd($token);
        //return response()->json(['user' => $user]);
        use Laravel\Passport\PersonalAccessTokenResult;*/
        //return response()->json(['user' => $user]);
// Create a new access token
        return $this->success([
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

     public function verify(EmailVerificationRequest $request)
     {
         $request->fulfill();

         return response()->json(['message' => 'Email verified successfully.']);
     }


    public function login(Request $request)
    {
        //$request->validated($request->all());
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return  $this->error('','Credentials do not match', 401);
        $user = User::where('email', $request->email)->first();
        if ($user->is_tutor){
            $tutor = User::with('tutor')->where('email', $request->email)->first();
            return $this->success([
                'user' => new TutorResource($tutor),
                'token' => $user->createToken('API Token of ' . $user->name)->accessToken
            ]);
        }


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

    public function logout($allDevices){

        if(Auth::id()!=null){
            if($allDevices)
                DB::table('oauth_access_tokens')
                    ->where('user_id', $accessToken->user_id)->delete();

            $accessToken = Auth::user()->token();
            $accessToken->revoke();
            $accessToken->delete();

            return $this->success([
                'message' => 'You have successfully been logged out and your token has been deleted.'
            ]);
        }
        return $this->error('', 'No token provided',401);
    }


}
