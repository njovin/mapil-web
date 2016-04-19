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
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/mongo', function () {
    $i = 0;
    while($i < 100) {
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $client->mapil->emails;
        $result = $collection->insertOne( [ 'subject' => 'Hinterland-' . $i, 'from' => 'hey2@me.com', 'user_id' => 1 ] );   
        $result = $collection->insertOne( [ 'subject' => 'Hinterland-' . $i, 'from' => 'hey2@me.com', 'user_id' => 1 ] );   
        $i++;
    }
    });
    Route::auth();

    // Email address managemenr
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

});


