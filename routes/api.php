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


Route::get('member', 'MemberController@index');
Route::post('member/insertMember', 'MemberController@store');
Route::put('member/updateMember', 'MemberController@update');

Route::post('userapp/insertUser', 'UserController@store');
Route::get('userapp/logIn', 'UserController@login');
Route::get('userapp/check', 'UserController@check');

Route::get('memberType', 'MemberTypeController@index');

Route::get('occupationType', 'OccupationTypeController@index');


