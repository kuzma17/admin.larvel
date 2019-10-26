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

Route::get('/about', ['as'=>'about']);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Admin*/

Route::group(['middleware' => ['status', 'auth']], function(){

    $groupData = [
        'namespace' => 'Admin',
        'prefix' => 'admin',
    ];

    Route::group($groupData, function (){
        //Route::resource('index', 'MainController')->name('admin.index');
        Route::resource('index', 'MainController');
    });
});


Route::get('/user/logout', ['as' => 'user.logout', 'uses' => 'Auth\LoginController@logout']);
