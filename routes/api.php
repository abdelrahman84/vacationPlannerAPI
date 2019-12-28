<?php
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



Route::group([
    'prefix' => 'manager',
    'middleware' => 'api'
], function ($router) {
    Route::post('signupmanager', 'ManagerController@signupManager');
    Route::post('adminlogin', 'ManagerController@adminLogin');   
   
});

    

Route::group([
    'middleware' => 'api'
], function ($router) {
    
    Route::post('login', 'AuthController@login');   
    Route::post('signup', 'AuthController@signup');
   
});

Route::group([
    'middleware' => 'jwt.auth', 'jwt.refresh'
], function ($router) {
    
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('resetpassword', 'ResetPasswordController@sendEmail');
    Route::post('changepassword', 'ChangePasswordController@changePassword');
    Route::post('submitnewvacation', 'VacationController@createVacation');
    Route::post('me', 'AuthController@me');
   
});