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
Route::get('/users', function()
{
    return 'Users!';
});

// 覆盖系统自带路由
Route::get('/auth/login', 'Auth\LoginController@showLoginForm');

Route::get('/test', 'TestController@index');
Route::get('/info', 'TestController@info');
Route::get('/event', 'TestController@event'); 
Route::get('/face', 'TestController@face'); 
Route::get('/visitor', 'VisitorController@index'); 
Route::get('/component', 'TestController@getComponent'); 



// 资源路由
Route::resource('photos', 'PhotoController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
