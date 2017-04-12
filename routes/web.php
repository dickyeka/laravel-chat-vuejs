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

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['namespace' => 'Api','prefix'=>'webapi'], function () {
    Route::get('/conversations', 'ConversationController@index');
    Route::post('/conversations', 'ConversationController@store');
    Route::post('/conversations/{conversation}/reply', 'ConversationReplyController@store');
    Route::post('/conversations/{conversation}/users', 'ConversationUserController@store');
    Route::get('/conversations/{conversation}', 'ConversationController@show');
});

Route::get('conversations', 'ConversationController@index');
Route::get('conversations/{conversation}', 'ConversationController@show');
