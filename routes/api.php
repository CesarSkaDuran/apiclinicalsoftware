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

Route::group([
    'middleware' => ['cors', 'require.https', 'auth:api'],
    'prefix' => 'rips'
], function ($router) {
    Route::get('config', 'RipsController@providerConfig');
    Route::put('config', 'RipsController@saveProviderConfig');
    Route::get('reports', 'RipsController@reports');
    Route::post('reports', 'RipsController@storeReport');
    Route::get('reports/{id}', 'RipsController@showReport');
});

Route::group([
    'middleware' => ['cors', 'require.https', 'auth:api'],
    'prefix' => 'dashboard'
], function ($router) {
    Route::get('summary', 'DashboardController@summary');
});

Route::group([
    'middleware' => ['cors', 'require.https', 'auth:api'],
    'prefix' => 'notifications'
], function ($router) {
    Route::post('daily-run', 'NotificationsController@runDaily');
    Route::get('birthdays-today', 'NotificationsController@birthdaysToday');
    Route::post('birthday/{patientId}', 'NotificationsController@sendBirthday');
});

route::post('uploadFile', 'API\CargaController@uploadFile');