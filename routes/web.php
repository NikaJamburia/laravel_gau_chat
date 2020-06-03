<?php

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

Route::get('/friends', "FriendsController@index");
Route::get('/notifications', "NotificationsController@index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/chat', 'ChatController');

Route::get('/friends/requests/send/{id}', 'FriendsController@sendRequest');
Route::post('/friends/requests/approve', 'FriendsController@acceptRequest');
Route::delete('/friends/requests/decline', 'FriendsController@declineRequest');
Route::get('/friends/search/{name}', 'FriendsController@searchByName');

Route::delete('/notifications', 'NotificationsController@hide');
