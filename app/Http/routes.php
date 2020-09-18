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
Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/terms', 'HomeController@terms');
    Route::auth();

    // Email address management
    Route::get('/email-addresses', 'EmailAddressController@index');
    Route::post('/email-addresses', 'EmailAddressController@save');
    Route::delete('/email-addresses', 'EmailAddressController@delete');

    // email logs UI
    Route::get('/messages', 'MessageController@index');
    Route::get('/messages/{id}/text', 'MessageController@viewText');
    Route::get('/messages/{id}/html', 'MessageController@viewHtml');
    Route::get('/messages/{id}/json', 'MessageController@viewJson');

    // API docs
    Route::get('/api-docs', 'ApiDocController@index');

    Route::get('/account', 'AccountController@index');
    Route::post('/account', 'AccountController@save');
});
Route::group(['middleware' => ['api', 'auth.stateless']], function () {
    // API
    Route::get('/api/v1/email-addresses', 'Api\ApiEmailAddressController@index');
    Route::post('/api/v1/email-addresses/{email}', 'Api\ApiEmailAddressController@create');
    Route::delete('/api/v1/email-addresses/{email}', 'Api\ApiEmailAddressController@delete');

    Route::get('/api/v1/email-addresses/{email}/messages', 'Api\ApiMessageController@index');
    Route::get('/api/v1/email-addresses/{email}/messages/{message_id}', 'Api\ApiMessageController@json');
    Route::get('/api/v1/email-addresses/{email}/messages/{message_id}/text', 'Api\ApiMessageController@text');
    Route::get('/api/v1/email-addresses/{email}/messages/{message_id}/html', 'Api\ApiMessageController@html');

    Route::delete('/api/v1/email-addresses/{email}/messages/{message_id}', 'Api\ApiMessageController@deleteMessage');
    Route::delete('/api/v1/email-addresses/{email}/messages', 'Api\ApiMessageController@deleteMessages');

});


