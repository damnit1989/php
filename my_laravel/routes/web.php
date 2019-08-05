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
    return view('home/welcome');
});
Route::get('/users', function()
{
    return 'Users!';
});

// 覆盖系统自带路由
Route::get('/auth/login', 'Auth\LoginController@showLoginForm');

Route::get('/test', 'Admin\TestController@index');
Route::get('/info', 'Admin\TestController@info')->middleware('test.after');
Route::get('/event', 'Admin\TestController@event'); 
Route::get('/face', 'Admin\TestController@face'); 
Route::get('/mk', 'Admin\TestController@mk'); 
Route::get('/job', 'Admin\TestController@job');
Route::get('/component', 'Admin\TestController@getComponent'); 

Route::get('/visitor', 'Admin\VisitorController@index'); 


// 资源路由
// Route::resource('phones', 'PhoneController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
