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

Route::get('list-student-data', 'StudentController@index');
Route::post('insert-student-data', 'StudentController@store');
Route::get('get-second-highest-money', 'StudentController@getPocketMoney');