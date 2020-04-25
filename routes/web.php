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
    return view('index');
});
Route::get('member', function(){
    return redirect('member/view');
});
Route::get('member/newmember', 'MemberController@new');
Route::get('member/view', 'MemberController@list');
Route::get('member/view/{id}', 'MemberController@get');
Route::get('member/edit/{id}', 'MemberController@edit');


