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

Route::group(['middleware' => ['authenticated']], function() {
    Route::get('/', 'UserController@dashboard')->name('dashboard');

    Route::group(['prefix' => 'org', 'middleware' => ['only_admin']], function() {

    });

    Route::group(['prefix' => 'user', 'middleware' => ['only_admin']], function() {

    });

    Route::group(['prefix' => 'feeder', 'middleware' => ['only_supply']], function() {

    });

    Route::group(['prefix' => 'validate', 'middleware' => ['only_supply']], function() {

    });

    Route::group(['prefix' => 'matchmaking', 'middleware' => ['only_demand']], function() {

    });
});

Route::get('/logout', 'AuthController@logout')->name('logout');
Route::any('/login', 'AuthController@login')->name('login');
