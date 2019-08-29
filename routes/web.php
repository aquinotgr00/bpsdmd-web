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
    Route::group(['prefix' => 'org', 'middleware' => ['only_admin']], function() {
        Route::any('/create', 'OrgController@create')->name('org.create');
        Route::any('/{org}/update', 'OrgController@update')->name('org.update');
        Route::get('/{org}/delete', 'OrgController@delete')->name('org.delete');
        Route::get('/', 'OrgController@index')->name('org.index');
    });

    Route::group(['prefix' => 'user', 'middleware' => ['only_admin']], function() {
        Route::any('/create/{type}', 'UserController@create')->name('user.create')
        ->where('type', \App\Entities\User::ROLE_ADMIN."|".\App\Entities\User::ROLE_SUPPLY."|".\App\Entities\User::ROLE_DEMAND);
        Route::any('/{user}/update', 'UserController@update')->name('user.update');
        Route::get('/{user}/delete', 'UserController@delete')->name('user.delete');
        Route::get('/', 'UserController@index')->name('user.index');
    });

    Route::group(['prefix' => 'feeder', 'middleware' => ['only_supply']], function() {
        Route::any('/upload/{year}', 'FeederController@upload')->name('feeder.upload');
    });

    Route::group(['prefix' => 'matchmaking', 'middleware' => ['only_demand']], function() {

    });

    Route::any('/user/update-profile', 'UtilityController@updateProfile')->name('update.profile');

    Route::group(['prefix' => 'data'], function() {
        Route::get('/school', 'UtilityController@dataSchool')->name('data.school');
        Route::get('/lecturer', 'UtilityController@dataLecturer')->name('data.lecturer');
        Route::get('/cadet', 'UtilityController@dataCadet')->name('data.cadet');
        Route::get('/course', 'UtilityController@dataCourse')->name('data.course');
    });

    Route::get('/', 'UtilityController@dashboard')->name('dashboard');
});

Route::get('/logout', 'AuthController@logout')->name('logout');
Route::any('/login', 'AuthController@login')->name('login');
