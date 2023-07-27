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
       //$request->validated();
       $path='';
        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'picture' => $path,
            'is_tutor' => true

        ]);

        $tutor = Tutor::create([
            'user_id' => $user->id,
            'bio' => $request->bio,
            'rate' => 0,
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name =$user->id . $image->getClientOriginalName();
            $path = $image->storeAs('public/Tutors/' . $tutor->tutor_id . '/Information', $image_name);
            $user->picture = $path;
            $user->save();
        }
        $id = $request->file('identify');
        $idPathName = $id->getClientOriginalName();
        $idPath = $id->storeAs('public/Tutors/'. $tutor->tutor_id . '/Information', $idPathName);
        $certif = $request->file('certification');
        $certifName = $certif->getClientOriginalName();
        $certifPath = $certif->storeAs('public/Tutors/'. $tutor->tutor_id . '/Information', $certifName);
        $cv = $request->file('C_V');
        $cvName = $cv->getClientOriginalName();
        $cvPath = $cv->storeAs('public/Tutors/'. $tutor->tutor_id . '/Information', $cvName);
        $tutor->id_photo = $idPath;
        $tutor->certification = $certifPath;
        $tutor->c_v = $cvPath;
        $tutor->save();
        return $tutor = User::with('tutor')->find($user->id);
        return response()->json([
            'tutor' => new TutorResource($tutor),
            'token' => $tutor->createToken('API Token of ' . $tutor->name)->accessToken
        ]);
     }

}
