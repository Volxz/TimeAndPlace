<?php

/*
|--------------------------------------------------------------------------
| Views
|--------------------------------------------------------------------------
| / --> auth/login
| /home --> from login
| 
| /user/changePassword
|
| /admin/userMaint
|
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. 
|
|  References: https://laracasts.com/discuss/channels/laravel/routehas
*/

/**** How to return a view right away: DO NOT DO THIS! You need middleware to authenticate everything.
Route::get('/', function () {
   return view('welcome');
});
*/


/*-------------Auth routes  (Authentication Routes...) -----------------*/
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Auth::routes(['register' => false]);
//Don't try and replicate these. 
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/*-------------Default routes  -----------------*/
Route::get('/home', 'HomeController@index')->name('home');

/*-----------------User Routes------------------*/
Route::get('/changePassword','UserController@showChangePasswordForm');
Route::post('/changePassword','UserController@changePassword')->name('changePassword');

/*----------------Admin Routes------------------*/
			/* kiosk handling routes */
Route::get('/addKiosk', 'AdminController@addKiosk');
Route::post('/addKiosk', 'AdminController@createKiosk');
Route::delete('/kiosks/{kiosk}','AdminController@deleteKiosk');

			/* user handling routes */
Route::get('/userMaint', 'AdminController@userIndex');
Route::get('showDefaultPWD', 'AdminController@showDefaultPWD')->name('showDefaultPWD');
Route::get('hideDefaultPWD', 'AdminController@hideDefaultPWD')->name('hideDefaultPWD');
//Route::post('addUser', 'AdminController@addUser')->name('addUser');
//Route::post('addUser', 'Auth\RegisterController@register')->name('addUser');//
Route::post('addUser', 'AdminController@createUser')->name('addUser');
Route::post('delUser', 'AdminController@deleteUser')->name('delUser');


/*----------------Kiosk Routes-------------*/
// add, delete are in Admin
Route::get('/kiosks', 'KioskController@index');
Route::get('/kiosks/{kiosk}/show', 'KioskController@show');
Route::get('/kiosks/{kiosk}/edit', 'KioskController@edit');
Route::patch('/kiosks/{kiosk}', 'KioskController@update');

/*----------------Attendance Routes-------------*/

/*----------------Report Routes-----------------*/



