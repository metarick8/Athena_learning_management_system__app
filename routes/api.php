<?php

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
Route::controller(UserController::class)->group(function(){
    Route::post('UserRegister', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'logout');
})->middleware('auth:api');
Route::post('TutorRegister', [TutorController::class, 'register']);


//////////////////////Course///////////////////////////
Route::get('/showall', [CourseController::class, 'getCourses']);
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
Route::post('/subscripe', [SubscriptionController::class, 'subscripe']);
///////////////////Rate///////////////////////////////
Route::post('/addRate/{id}', [RateController::class, 'addRate']);
Route::get('/getRate/{id}', [RateController::class, 'getRate']);
//////////////////Follow/////////////////////////////
Route::post('/follow/{id}', [FollowController::class, 'follow']);
//////////////////Watch_Later////////////////////////
Route::post('/watchLater/{id}', [WatchLaterController::class, 'watch_later']);
Route::get('/watchList', [WatchLaterController::class, 'getWatch']);
/////////////////Book_Mark//////////////////////////
Route::post('/bookmark/{id}', [BookmarkController::class, 'bookmark']);
Route::get('/getbookmarks', [BookmarkController::class, 'getbookmarks']);
/////////////////Private_Course/////////////////////
Route::post('/addPrivate', [PrivateCourseController::class, 'add_Private_Course']);
/////////////////Private_Subscription///////////////
Route::post('/PrivateSubscripe', [SubscriptionForPrivateController::class, 'Private_subscripe']);

