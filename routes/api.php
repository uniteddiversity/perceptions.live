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

Route::group(['middleware' => []], function()
{
    Route::get('/calculate_video_cost/{_token}', '\App\Controllers\User\UserController@calculateVideoCost');
    Route::post('/generate_invoice/{_token}', '\App\Controllers\User\UserController@generateInvoice');
    Route::get('/close_project/{_token}', '\App\Controllers\User\UserController@closeProject');
});