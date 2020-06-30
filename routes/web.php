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



Route::get('/', 'IndexController@index');

Route::get('login/{token}', 'IndexController@index2');

Route::get('login', 'LoginController@loginIndex');

Route::get('logout', 'UserController@logout');

Route::get('register', function(){
    return view('authentication/user_register', ['sLevelDir' => config('constants.level1')]);
});

Route::get('forgotPassword', function(){
    return view('authentication/user_forgot_password', ['sLevelDir' => config('constants.level1')]);
});

Route::get('member', function(){
    return redirect('member/view');
});
Route::get('member/newmember', 'MemberController@new');
Route::get('member/view', 'MemberController@list');
Route::get('member/view/{id}', 'MemberController@get');
Route::get('member/edit/{id}', 'MemberController@edit');


Route::get('configuration/memberType', 'MemberTypeController@list');
Route::get('congiguration/occupationType', 'OccupationTypeController@list');


