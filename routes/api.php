<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Authentication\TutorController;
use App\Http\Controllers\Authentication\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\WatchLaterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\PrivateCourseController;
use App\Http\Controllers\SubscriptionForPrivateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Authentication
/*
Route::post('/UserRegister', [UserController::class,'register']);
Route::post('/login', [UserController::class,'login']);
*/

//
Route::controller(UserController::class)->group(function(){
    Route::post('user/register', 'register');
    Route::post('login', 'login');
})->middleware('auth:api');
Route::post('TutorRegister', [TutorController::class, 'register']);

//
Route::get('/email/verify', function () {
    return view('auth.verif y-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::group(['middleware' => 'auth:api'], function () {

    Route::get('logout/{allDevices}', [UserController::class, 'logout']);
    //////////////////////Course///////////////////////////
Route::get('/allCourses', [CourseController::class, 'getCourses']);
Route::post('/addCourse', [CourseController::class, 'addCourse']);
Route::delete('/delete/{id}', [CourseController::class, 'deleteCourse']);
Route::get('/showCourse/{id}', [CourseController::class, 'showCourse']);
Route::post('/search/{id}', [CourseController::class, 'findCourse']);///?
/////////////////////Module////////////////////////////
Route::post('/addModule', [ModuleController::class, 'addModule']);
Route::post('/showModule/{id}', [ModuleController::class, 'showModule']);
////////////////////Video/////////////////////////////
Route::post('/addVideo', [VideoController::class, 'addVideo']);
Route::get('/showVideo/{id}', [VideoController::class, 'showVideo']);
///////////////////subscription///////////////////////
Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
///////////////////Rate///////////////////////////////
Route::post('/addRate', [RateController::class, 'addRate']);
Route::get('/getRate/{id}', [RateController::class, 'getRate']);
//////////////////Follow/////////////////////////////
Route::post('/follow/{id}', [FollowController::class, 'follow']);
Route::post('/unfollow/{id}', [FollowController::class, 'unfollow']);
Route::get('/getFollowers', [FollowController::class, 'getFollowers']);
//////////////////Watch_Later////////////////////////
Route::post('/addWishlist/{id}', [WatchLaterController::class, 'watch_later']);
Route::get('/getWishlist', [WatchLaterController::class, 'getWatch']);
/////////////////Book_Mark//////////////////////////
Route::post('/addBookmark', [BookmarkController::class, 'addBookmark']);
Route::post('/deleteBookmark', [BookmarkController::class, 'deleteBookmark']);
Route::get('/getBookmarks', [BookmarkController::class, 'getBookmarks']);
/////////////////Private_Course/////////////////////
Route::post('/addPrivate', [PrivateCourseController::class, 'add_Private_Course']);
/////////////////Private_Subscription///////////////
Route::post('/PrivateSubscripe', [SubscriptionForPrivateController::class, 'Private_subscripe']);


});

