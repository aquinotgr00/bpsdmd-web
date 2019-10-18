<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/employee/get-by-name', 'Demand\EmployeeController@getByName')->name('demand.employee.get_by_name');
Route::post('/district/get-by-name', 'Demand\DistrictController@getByName')->name('demand.district.get_by_name');