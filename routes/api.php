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

Route::middleware('auth:api')->group(function () {
    Route::apiResource('businesses/{business_id}/options', 'Api\BusinessOptionController')->only(['destroy', 'index', 'store']);
    Route::apiResource('businesses/{business_id}/services', 'Api\BusinessServiceController')->only(['destroy', 'index', 'store']);
    Route::apiResource('businesses', 'Api\BusinessController')->only(['destroy', 'store', 'update']);
    Route::apiResource('media', 'Api\MediaController')->only(['destroy', 'store']);
    Route::apiResource('services/requests', 'Api\ServiceRequestController')->only(['destroy', 'store', 'update']);

    Route::get('/users/me', function (Request $request) {
        return $request->user();
    });
});

Route::apiResource('businesses', 'Api\BusinessController')->only(['index', 'show']);
Route::get('/media', 'Api\MediaController@index');
Route::get('/options', 'Api\OptionController@index');
Route::get('/services', 'Api\ServiceController@index');
Route::apiResource('services/requests', 'Api\ServiceRequestController')->only(['index', 'show']);
Route::post('/users', 'Auth\RegisterController@register');
