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

Route::prefix('client')->group(function () {

    Route::get('','ClientController@index')->name('client.index');
    Route::get('create', 'ClientController@create')->name('client.create');
    Route::post('store', 'ClientController@store')->name('client.store');
    Route::post('destroy/{client}', 'ClientController@destroy')->name('client.destroy');

    // Route::get('createclients', 'ClientController@createclients')->name('client.createclients');
    // Route::get('createjavascript', 'ClientController@createjavascript')->name('client.createjavascript');

    // Route::post('storeclients', 'ClientController@storeclients')->name('client.storeclients');
    // Route::post('storejavascript', 'ClientController@storejavascript')->name('client.storejavascript');




});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
