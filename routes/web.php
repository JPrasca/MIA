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
    return view('index', [
        'title' => Config::get('constants.name'), 
        'name' => Config::get('constants.name'), 
        'author' => Config::get('constants.author'), 
        'dataYear' => Config::get('constants.dataYear')
    ]);
});
Route::get('person/', 'personController@index');
