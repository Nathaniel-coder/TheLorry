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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/receipt&Invoice', 'RICController@index');
Route::get('/invoiceDropOff/{id}', 'RICController@invoiceDrop');
Route::get('/invoicePickUP/{id}', 'RICController@invoicePick');
Route::get('pickXML/{id}', 'RICController@XMLPick');
Route::get('dropXML/{id}', 'RICController@XMLDrop');
Route::get('rateXML', 'RICController@XMLRates');
Route::get('PAXML', 'RICController@PickXMLAll');
Route::get('DAXML', 'RICController@DropXMLAll');
Route::get('dropCSV', 'RICController@DropCSV');
Route::get('pickCSV', 'RICController@PickCSV');
Route::get('warehouseCSV', 'RICController@WarehouseCSV');
Route::get('csv', 'RICController@CSV');

//QRCODE
Route::get('dropQR/{id}', 'RICController@DropQR');
Route::get('pickQR/{id}', 'RICController@pickQR');
Route::get('ConsignmentDrop', 'RICController@ConsignmentDrop');

//404 counter
Route::get('{path}', "HomeController@index")->where('path', '([A-z\/_.\d]+)?');
