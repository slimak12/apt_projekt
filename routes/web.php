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

Route::get('/', 'HomeController@index');

Auth::routes();


Route::resource('/contest', 'ContestController');


Route::get('/accept_user/{contest_id}/{user_id}', 'ContestController@accept_user')->name('accept_user');

Route::post('/save_user_result', 'ContestController@update_result')->name('update_result');

Route::get('/add_to_contest/{contest_id}','ContestController@add_to_contest' )->name('add_to_contest');