<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'AuthController@login');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/logout', 'AuthController@logout');
    Route::resource('users' , 'AdminContoller');
    Route::resource('/Changepassword' , 'PasswordController');
    Route::resource('Employees' , 'EmployeesController');
    Route::resource('Assign' , 'AssignController');
    Route::post('/register', 'AuthController@register');


});




Route::resource('Teams' , 'TeamController');
