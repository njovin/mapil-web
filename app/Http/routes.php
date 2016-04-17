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

Route::post('/test', function (Illuminate\Http\Request $request) {
    // throw new Exception('hey');
    return response()->json(['new_token' => csrf_token(),'id' => 123,'email' => $request->input('email')]);
});
Route::auth();

Route::get('/addresses', 'EmailAddressController@index');
Route::post('/addresses', 'EmailAddressController@save');
Route::delete('/addresses', 'EmailAddressController@delete');
Route::get('/logs', 'LogController@index');
