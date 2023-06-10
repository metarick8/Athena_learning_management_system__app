<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\WatchLaterController;
use App\Http\Controllers\BookmarkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
//////////////////////Course///////////////////////////
Route::get('/showall', [CourseController::class, 'getCourses']);
Route::post('/addCourse', [CourseController::class, 'addCourse']);
Route::post('/delete/{id}', [CourseController::class, 'deleteCourse']);
Route::get('/showCourse/{id}', [CourseController::class, 'showCourse']);
Route::get('/search', [CourseController::class, 'findCourse']);///?
/////////////////////Module////////////////////////////
Route::post('/addModule', [ModuleController::class, 'addModule']);
Route::get('/showModule/{id}', [ModuleController::class, 'showModule']);
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
