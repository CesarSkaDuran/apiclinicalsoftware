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

Route::group([
   'middleware' => ['cors'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Authentication\LoginAppUserController@login');
    Route::post('register', 'Authentication\RegisterAppUserController@register');
    //    Route::post('logout', 'AuthController@logout');
    //    Route::post('refresh', 'AuthController@refresh');
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'actions'
], function ($router) {
    Route::post('doctorForm', 'DoctorFormController@create');
    Route::post('patientProfile', 'FilesController@patientProfile');
    Route::post('recordMultimedia', 'FilesController@recordMultimedia');
    Route::post('comprobanteMultimedia', 'ComprobanteController@comprobanteMultimedia');
});

route::post('uploadFile', 'API\CargaController@uploadFile');