<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Shirley
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('rateXML', 'RICController@XMLRates');
Route::get('pickXML/{id}', 'RICController@XMLPick');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/receipt&Invoice', 'RICController@index');

//Vernice
Route::get('DAXML', 'RICController@DropXMLAll');
Route::get('dropXML/{id}', 'RICController@XMLDrop');
Route::get('/invoiceDropOff/{id}', 'RICController@invoiceDrop');

//Nathaniel
    //404 counter
Route::get('{path}', "HomeController@index")->where('path', '([A-z\/_.\d]+)?');
//Send Email
Route::get('email', 'MailController@index');
Route::post('sendEmail', 'MailController@purchase');
//CSV PDF QRCODE
Route::get('dropCSV', 'RICController@DropCSV');
Route::get('pickCSV', 'RICController@PickCSV');
Route::get('warehouseCSV', 'RICController@WarehouseCSV');
Route::get('csv', 'RICController@CSV');
Route::get('dropQR/{id}', 'RICController@DropQR');
Route::get('pickQR/{id}', 'RICController@pickQR');
Route::get('ConsignmentDrop', 'RICController@ConsignmentDrop');
Route::get('ConsignmentPick', 'RICController@ConsignmentPick');
Route::get('PickConsignment/{id}', 'RICController@PickConsignment');
Route::get('DropConsignment/{id}', 'RICController@DropConsignment');
Route::post('download', 'RICController@download');
Route::get('PAXML', 'RICController@PickXMLAll');
Route::get('/invoicePickUP/{id}', 'RICController@invoicePick');
//Email
Route::post('/subscribe', 'MailController@purchase');

