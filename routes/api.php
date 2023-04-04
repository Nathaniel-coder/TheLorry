<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['user' => 'API\UserController']);
Route::apiResources(['branch' => 'API\BranchController']);
Route::apiResources(['vehicle' => 'API\VehicleController']);
Route::get('branches', 'API\VehicleController@branch');
Route::get('findBranch', 'API\UserController@search');
Route::get('profile', 'API\UserController@Profile');
Route::put('profile', 'API\UserController@updateProfile');
Route::get('findUser', 'API\UserController@search');
Route::get('dashboard', 'API\DashBoardController@index');
Route::get('invoice/{date}', 'API\DropOffController@invoice');
Route::apiResources(['dropOff' => 'API\DropOffController']);
Route::apiResources(['pickUp' => 'API\PickUpController']);
Route::get('dropOffCount', 'API\DropOffController@count');
Route::get('pickUpCount', 'API\PickUpController@count');
