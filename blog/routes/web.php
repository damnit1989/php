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
// Route::get('/users', function()
// {
    // return 'Users!';
// });
Route::get('/lmm',function(){
	$environment = app()->environment();
	$name = Route::currentRouteName();
	// dd($name);
	print_R($environment);
	 dd(app());
	 phpinfo();
});
// Route::get('/', 'Auth\LoginController@index');
Route::any('/foo',['middleware' => ['auth']],function(){
	return 'hello world';
	// die('sdfsdfds');
    // return view('test');
});


// Route::get('auth/login', 'Auth\AuthController@getLogin');
// Route::post('auth/login', 'Auth\AuthController@postLogin');
// Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['namespace' => 'Admin','prefix' => 'admin'], function()
{
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
	Route::get('test/{name?}', function($name = null)
	{
		echo $name;
	});

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
