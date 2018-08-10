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


Route::post('user/login', array('uses' => '\App\Http\Controllers\Auth\LoginController@userLogin'));
Route::post('user/register', array('uses' => '\App\Http\Controllers\Auth\RegisterController@createUser'));

Route::post('/', function(){

})->name('login');

Route::get('/', array('uses' => '\App\Controllers\HomeController@home'))->name('home');
Route::get('/location/{_video_id}', array('uses' => '\App\Controllers\HomeController@location'));
Route::get('/profile/video/{_video_id}', array('uses' => '\App\Controllers\HomeController@videoProfile'));
Route::get('/ajax-available-videos', array('uses' => '\App\Controllers\HomeController@ajaxVideos'))->name('home');
Route::get('/ajax-available-videos/{_id}', array('uses' => '\App\Controllers\HomeController@ajaxVideosNew'));
Route::get('/home/ajax-video-info/{_video_id}', '\App\Controllers\HomeController@getVideoInfo');

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'web', 'admin']], function () {
    Route::get('/profile', '\App\Controllers\User\UserController@profile');
    Route::get('/upload-video', '\App\Controllers\User\UserController@uploadVideo');
    Route::post('/post-upload-video', '\App\Controllers\User\UserController@postUploadVideo');
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@userLogout');

    Route::get('/admin/user-list', '\App\Controllers\User\UserController@userList');
    Route::get('/admin/group-list', '\App\Controllers\User\UserController@groupList');
    Route::get('/admin/user-add', '\App\Controllers\User\UserController@userAdd');
    Route::get('/admin/user-edit/{_user_id}', '\App\Controllers\User\UserController@adminUserEdit');
    Route::get('/admin/video-edit/{_user_id}', '\App\Controllers\User\UserController@contentEdit');
    Route::post('/admin/post-user-add', '\App\Controllers\User\UserController@adminUserAdd');
    Route::get('/admin/content-list', '\App\Controllers\User\UserController@contentList');
    Route::get('/admin/content-add', '\App\Controllers\User\UserController@contentAdd');
    Route::post('/admin/post-content-add', '\App\Controllers\User\UserController@contentAdd');
    Route::get('admin/user-group-add', '\App\Controllers\User\UserController@groupAdd');
    Route::get('admin/user-to-group-add', '\App\Controllers\User\UserController@userToGroupAdd');
    Route::get('admin/user-to-group-add/{_group_id}', '\App\Controllers\User\UserController@userToGroupAdd');

    Route::post('admin/post-group-add', '\App\Controllers\User\UserController@postGroupAdd');
    Route::post('admin/post-user-group-add/{_group_id}', '\App\Controllers\User\UserController@postUserToGroupAdd');

    Route::get('admin/sorting-tag-add', '\App\Controllers\User\UserController@sortingTagAdd');
    Route::post('admin/post-sorting-tag-add', '\App\Controllers\User\UserController@postSortingTagAdd');

    Route::get('/admin/group-edit/{_group_id}', '\App\Controllers\User\UserController@editGroup');
});