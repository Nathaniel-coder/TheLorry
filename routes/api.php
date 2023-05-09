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


//Shirley
Route::apiResources(['branch' => 'API\BranchController']);
Route::apiResources(['shop' => 'API\ShopController']);
Route::get('branches', 'API\VehicleController@branch');
Route::get('Branches', 'API\DropOffController@branches');
Route::get('shopIndex', 'API\ShopController@index');
Route::get('invoice/{date}', 'API\DropOffController@invoice');
Route::get('dropOffCount', 'API\DropOffController@count');
Route::get('pickUpCount', 'API\PickUpController@count');
Route::get('shop', 'API\UserController@Shop');
//XML Generator
Route::get('items/{ID}', 'API\XMLController@WarehouseItem');



//Vernice
Route::apiResources(['user' => 'API\UserController']);
Route::apiResources(['warehouse' => 'API\WarehouseController']);
Route::apiResources(['dropOff' => 'API\DropOffController']);
Route::apiResources(['pickUp' => 'API\PickUpController']);
Route::get('profile', 'API\UserController@Profile');
Route::put('profile', 'API\UserController@updateProfile');
Route::get('findUser', 'API\UserController@search');
Route::get('findBranch', 'API\UserController@search');
//XML Generator
Route::get('truckD/{dropID}', 'API\XMLController@DropXML');


//Nathaniel
Route::apiResources(['vehicle' => 'API\VehicleController']);
Route::apiResources(['dashboard' => 'API\DashboardController']);
Route::get('dropOffCount', 'API\DashboardController@DropCount');
Route::get('pickUpCount', 'API\DashboardController@PickCount');
Route::get('chart', 'API\DashboardController@chart');
Route::get('provinceDataDrop', 'API\DashboardController@provinceDataDrop');
Route::get('provinceDataPick', 'API\DashboardController@provinceDataPick');
Route::get('generated', 'API\DashboardController@totalGenerated');
Route::get('donutdrop', 'API\DashboardController@donutdrop');
Route::get('warehouseChart', 'API\DashboardController@warehouseChart');
Route::get('brandChart', 'API\DashboardController@brandChart');
Route::get('chartData', 'API\DashboardController@chartData');
    //Make payment
Route::post('paymentDrop', 'API\DropOffController@payment');
Route::post('paymentPick', 'API\PickUpController@payment');
    //XML Generator
Route::get('truckP/{pickID}', 'API\XMLController@PickXML');
