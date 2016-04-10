<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (Illuminate\Http\Request $request) {
    return response()->json(['ok' => 'cool']);
});
Route::auth();

Route::get('/addresses', 'EmailAddressController@index');
Route::get('/logs', 'LogController@index');
