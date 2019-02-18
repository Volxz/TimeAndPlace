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
Route::get('/home1', 'HomeController@home1');

/*----------------Admin Routes------------------*/
Route::get('/userMaint', 'AdminController@userIndex');
Route::get('showDefaultPWD', 'AdminController@showDefaultPWD')->name('showDefaultPWD');
Route::get('hideDefaultPWD', 'AdminController@hideDefaultPWD')->name('hideDefaultPWD');
//Route::post('addUser', 'AdminController@addUser')->name('addUser');
//Route::post('addUser', 'Auth\RegisterController@register')->name('addUser');//
Route::post('addUser', 'AdminController@createUser')->name('addUser');
Route::post('delUser/{id}', 'AdminController@deleteUser')->name('delUser');

/*-----------------User Routes------------------*/
Route::get('/changePassword','UserController@showChangePasswordForm');
Route::post('/changePassword','UserController@changePassword')->name('changePassword');

/*----------------Kiosk Routes-------------*/
Route::get(   '/kiosks', 'KioskController@index');
Route::get(   '/kiosks/create', 'KioskController@create');
Route::post(  '/kiosks', 'KioskController@store');
Route::get(   '/kiosks/{kiosk}/show', 'KioskController@show');
Route::get(   '/kiosks/{kiosk}/edit', 'KioskController@edit');
Route::patch( '/kiosks/{kiosk}', 'KioskController@update');
Route::delete('/kiosks/{kiosk}','KioskController@destroy');

/*----------------Kiosk-User Routes-------------*/
// Route::patch('/kiosks/{kiosk}/users/{user}', 'HomeController@index');
// Route::patch('/kiosks/{kiosk}/users/{user}', 'KioskUserController@update');
// Route::post('/kiosks/{kiosk}/attach/{user}', 'KioskUsersController@attach');
// Route::post('/kiosks/{kiosk}/detach/{id}', 'KioskUsersController@detach');
//The following is being done with simple URL redirects .: get method and not CSRF 
Route::get('/kiosks/{kiosk}/users/{user}', 'KioskUserController@toggleKioskAdmin');
Route::get('/kiosks/{kiosk}/attach/{user}', 'KioskUserController@attach');
Route::get('/kiosks/{kiosk}/detach/{user}', 'KioskUserController@detach');

/*----------------Terminal Routes-------------*/
Route::get('/terminals/{kiosk}', 'TerminalController@launch');
Route::get('/bpterminal/{kiosk}', 'TerminalController@launchbp');

/*----------------Log file routes-------------*/
Route::post('/terminals/{kiosk}/toggleStudent/{student}', 'TerminalController@toggleStudent');

/*----------------Student Routes-------------*/
Route::get('/students', 'StudentController@index');
Route::get('/students/{id}', 'StudentController@show');
Route::get('/students2/', 'StudentController@showCourse');

/*----------------Attendance Routes-------------*/

/*----------------Report Routes-----------------*/

