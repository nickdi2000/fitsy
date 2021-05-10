<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Custom\PlansController;
use App\Http\Controllers\Custom\DaysController;
use App\Http\Controllers\Custom\ExercisesController;

use App\Http\Controllers\Custom\UsersController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
		//Route::get('logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);

    });
});

  //routes for the "custom" extension wchich is the current app we are creating (fitsy, hotels plus)
  Route::resource('plans', PlansController::class);

  Route::resource('days', DaysController::class);
  Route::get('days/by-plan/{id}', [DaysController::class, 'byPlan']);

  Route::get('exercises/list', [ExercisesController::class, 'list']);
  Route::get('exercises/get-by-day/{id}', [ExercisesController::class, 'getByDay']);
  Route::resource('exercises', ExercisesController::class);

  //public user APIs
  Route::group(['prefix' => 'pub'], function () {
    Route::get('user/stats', [UsersController::class, 'stats']);
  });



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
