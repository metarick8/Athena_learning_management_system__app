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
        Storage::makeDirectory('Users');
        Storage::makeDirectory('Tutors');

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
            $image_name =$user->username .'.'. $image->getClientOriginalExtension();
            $path = $image->storeAs('Users', $image_name);
            $user->picture = $path;
            $user->save();
        }

        $user->sendEmailVerificationNotification();
        return $this->success('','email pending to verify');
     }

     public function resend($id) {
        $user = User::findOrFail($id);
        if ($user->hasVerifiedEmail()) {
            return $this->error('', 'Email already verified.', 400);
        }

        $user->sendEmailVerificationNotification();

        return $this->success('','Email verification link sent on your email id');
    }


    public function login(Request $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return  $this->error('','Credentials do not match', 401);
        $user = User::where('email', $request->email)->first();
        /*if($user->email_verified_at == null)
            return  $this->error('','Email not Verified', 400);*/
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
            $accessToken = Auth::user()->token();
            if($allDevices){
                DB::table('oauth_access_tokens')
                    ->where('user_id', $accessToken->user_id)->delete();
                return $this->success([
                    'message' => 'You have successfully been logged out from all devices.'
                ]);
            }
            $accessToken->revoke();
            $accessToken->delete();

            return $this->success([
                'message' => 'You have successfully been logged out and your token has been deleted.'
            ]);
        }
        return $this->error('', 'No token provided',401);
    }


}
