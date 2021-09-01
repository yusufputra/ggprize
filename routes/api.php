<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ReferencedController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => 'jwt.verify'], function () {
    //route here
    Route::get('/userinfo', [UserController::class, 'getAuthenticatedUser']);

    Route::post('/addDiamond', [RewardController::class, 'addDiamond']);
    Route::get('/getTotalDiamond', [RewardController::class, 'getTotal']);

    Route::post('/createEvent', [EventController::class, 'addEvent']);
    Route::get('/getAllEvent', [EventController::class, 'getAllEvent']);
    Route::get('/detailEvent/{id}', [EventController::class, 'detailEvent']);

    Route::get('/referal/{code}', [ReferencedController::class, 'useCode']);    
});
