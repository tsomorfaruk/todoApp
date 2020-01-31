<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/store', 'TodosController@store');
Route::get('/showall', 'TodosController@showAll');
Route::put('/update/status', 'TodosController@updateStatus');
Route::put('/update/todo', 'TodosController@updateTodo');
Route::delete('/delete/{id}', 'TodosController@deleteTodo');
Route::get('/delete/completed', 'TodosController@deleteCompleted');
