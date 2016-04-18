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

Route::get('/addresses', 'EmailAddressController@index');
Route::post('/addresses', 'EmailAddressController@save');
Route::delete('/addresses', 'EmailAddressController@delete');
Route::get('/logs', 'LogController@index');
Route::get('/logs/{id}/text', 'LogController@viewText');
Route::get('/logs/{id}/html', 'LogController@viewHtml');
Route::get('/logs/{id}/json', 'LogController@viewJson');
Route::get('/api-docs', 'ApiDocController@index');
