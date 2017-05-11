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

Route::get('/', 'TaskController@index');
Route::get('/completed', 'TaskController@showCompleted');
Route::get('/new', 'TaskController@new');
Route::post('/new', 'TaskController@saveNew');
Route::get('/edit/{id}', 'TaskController@edit');
Route::post('/edit', 'TaskController@saveEdits');
Route::get('/delete/{id}', 'TaskController@delete');
Route::post('/delete', 'TaskController@saveDelete');
Route::post('/complete', 'TaskController@markComplete');
Route::post('/incomplete', 'TaskController@markIncomplete');
Route::get('/mytasks', 'TaskController@showMyTasks');
Route::get('/mytasks/completed', 'TaskController@showMyCompleted');
Route::get('/{memberid}', 'TaskController@showMemberTasks');
Route::get('/{memberid}/completed', 'TaskController@showMemberCompleted');
