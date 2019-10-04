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

use App\Entities\User;

Route::group(['middleware' => ['authenticated']], function() {
    Route::group(['prefix' => 'org', 'middleware' => ['only_admin']], function() {
        Route::any('/create', 'OrgController@create')->name('org.create');
        Route::any('/{org}/update', 'OrgController@update')->name('org.update');
        Route::get('/{org}/delete', 'OrgController@delete')->name('org.delete');
        Route::get('/{org}', 'OrgController@ajaxDetailOrg')->name('org.view');
        Route::get('/', 'OrgController@index')->name('org.index');

        Route::group(['prefix' => '{org}/program/', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'ProgramController@create')->name('program.create');
            Route::any('/{program}/update', 'ProgramController@update')->name('program.update');
            Route::get('/{program}/delete', 'ProgramController@delete')->name('program.delete');
            Route::get('/', 'ProgramController@index')->name('program.index');
        });
    });

    Route::group(['prefix' => 'user', 'middleware' => ['only_admin']], function() {
        Route::any('/create/{type}', 'UserController@create')->name('user.create')->where('type', User::ROLE_ADMIN."|". User::ROLE_SUPPLY."|". User::ROLE_DEMAND);
        Route::any('/{user}/update', 'UserController@update')->name('user.update');
        Route::get('/{user}/delete', 'UserController@delete')->name('user.delete');
        Route::get('/{user}/enable', 'UserController@enable')->name('user.enable');
        Route::get('/{user}/disable', 'UserController@disable')->name('user.disable');
        Route::get('/{user}', 'UserController@ajaxDetailUser')->name('user.view');
        Route::get('/', 'UserController@index')->name('user.index');
    });

//    Route::group(['prefix' => 'feeder', 'middleware' => ['only_supply']], function() {
//        Route::any('/upload/{year}', 'FeederController@upload')->name('feeder.upload');
//    });

//    Route::group(['prefix' => 'link-and-match', 'middleware' => ['only_admin']], function() {
//        Route::any('/{type}/index', 'LinkAndMatchController@indexAdmin')->name('linknmatch.admin.index')->where('type', \App\Entities\User::ROLE_ADMIN);
//        Route::any('/prodi-by-instansi', 'LinkAndMatchController@getProdiByInstansi')->name('linknmatch.getProdiByInstansi');
//        Route::any('/kompetensi-by-supply', 'LinkAndMatchController@getKompetensiByProdi')->name('linknmatch.getKompetensiByProdi');
//        Route::any('/demand-by-kompetensi', 'LinkAndMatchController@getDemandByKompetensi')->name('linknmatch.getDemandByKompetensi');
//    });

    Route::group(['prefix' => 'student', 'middleware' => ['only_supply']], function() {
        Route::any('/create', 'StudentController@create')->name('student.create');
        Route::any('/{student}/update', 'StudentController@update')->name('student.update');
        Route::get('/{student}/delete', 'StudentController@delete')->name('student.delete');
        Route::get('/{student}', 'StudentController@ajaxDetailStudent')->name('student.view');
        Route::get('/', 'StudentController@index')->name('student.index');
    });

    Route::group(['prefix' => 'teacher', 'middleware' => ['only_supply']], function() {
        Route::any('/create', 'TeacherController@create')->name('teacher.create');
        Route::any('/{teacher}/update', 'TeacherController@update')->name('teacher.update');
        Route::get('/{teacher}/delete', 'TeacherController@delete')->name('teacher.delete');
        Route::get('/{teacher}', 'TeacherController@ajaxDetailTeacher')->name('teacher.view');
        Route::get('/', 'TeacherController@index')->name('teacher.index');
    });

    Route::group(['prefix' => 'employee', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'EmployeeController@create')->name('employee.create');
        Route::any('/{employee}/update', 'EmployeeController@update')->name('employee.update');
        Route::get('/{employee}/delete', 'EmployeeController@delete')->name('employee.delete');
        Route::get('/{employee}', 'EmployeeController@ajaxDetailEmployee')->name('employee.view');
        Route::get('/', 'EmployeeController@index')->name('employee.index');
    });

    Route::group(['prefix' => 'data'], function() {
        Route::get('/school', 'UtilityController@dataSchool')->name('data.school');
        Route::get('/lecturer', 'UtilityController@dataLecturer')->name('data.lecturer');
        Route::get('/cadet', 'UtilityController@dataCadet')->name('data.cadet');
        Route::get('/course', 'UtilityController@dataCourse')->name('data.course');
    });

    Route::any('/update-profile', 'UtilityController@updateProfile')->name('update.profile');
    Route::get('/', 'UtilityController@dashboard')->name('dashboard');
});

Route::any('/verify/{id}', 'AuthController@verifyUser')->name('verify.user');
Route::any('/register', 'AuthController@register')->name('register');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::any('/login', 'AuthController@login')->name('login');
