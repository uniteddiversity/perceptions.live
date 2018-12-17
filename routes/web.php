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


Route::get('/register/confirm/resend', 'Auth\RegisterController@resendConfirmation')->name('auth.resend_confirmation');
Route::get('/register/confirm/{confirmation_code}', 'Auth\RegisterController@confirm')->name('auth.confirm');

Route::post('/', function(){

})->name('login');

//Route::group(['middleware' => ['guest']], function () {
    Route::get('/', array('uses' => '\App\Controllers\HomeController@home'))->name('home');
    Route::get('/location/{_video_id}', array('uses' => '\App\Controllers\HomeController@location'));
    Route::get('/profile/video/{_video_id}', array('uses' => '\App\Controllers\HomeController@videoProfile'));
    Route::get('/ajax-available-videos', array('uses' => '\App\Controllers\HomeController@ajaxVideos'))->name('home');
    Route::get('/ajax-available-videos/{_id}', array('uses' => '\App\Controllers\HomeController@ajaxVideosNew'));
    Route::get('/home/ajax-video-info/{_video_id}', '\App\Controllers\HomeController@getVideoInfo');
    Route::get('/home/ajax-video-info-small/{_video_id}', '\App\Controllers\HomeController@getVideoInfoMini');
    Route::get('/home/ajax-user-info/{_user_id}', '\App\Controllers\HomeController@getUserInfo');
    Route::get('/home/ajax-group-info/{_group_id}', '\App\Controllers\HomeController@getGroupInfo');

    Route::get('/home/ajax/video-search', '\App\Controllers\HomeController@searchVideos');
    Route::get('/claim-profile', '\App\Controllers\User\UserController@claimUserProfile');
    Route::get('/claim-profile-clean', '\App\Controllers\User\UserController@claimUserProfileClean');
    Route::post('/claim-profile-post', '\App\Controllers\User\UserController@claimUserProfilePost');


    Route::get('/ajax/associated_videos_by_user_id/{_user_id}', '\App\Controllers\User\UserController@getAssociatedVideosByUserId');
    Route::get('/home/ajax/video-search-list', '\App\Controllers\HomeController@searchVideosList');
    Route::get('/home/ajax/user-search-list', '\App\Controllers\HomeController@searchUsersList');
    Route::get('/home/ajax/group-search-list', '\App\Controllers\HomeController@searchGroupList');
    Route::get('/home/ajax/primary_subject_tag', '\App\Controllers\HomeController@searchPrimarySubjectTagList');

    Route::get('/home/shared/group/{_id}', '\App\Controllers\HomeController@sharedGroup');
    Route::get('/ajax/home/shared/group/{_id}', '\App\Controllers\HomeController@shearedContentJson');

    Route::get('/home/ajax-video-more-info/{_video_id}', '\App\Controllers\HomeController@getVideoMoreInfo');
//});



/*

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
    Route::get('/admin/location-list', '\App\Controllers\ContentController@adminLocationList');
});

 */

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'web']], function () {
    Route::get('/content-add', '\App\Controllers\User\UserController@uploadVideo');
    Route::post('/post-upload-video', '\App\Controllers\User\UserController@postUploadVideo');
    Route::get('/profile', '\App\Controllers\User\UserController@profile');
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@userLogout');
    Route::get('/user-profile', '\App\Controllers\User\UserController@profileSettings');
    Route::post('/user-profile-post', '\App\Controllers\User\UserController@postProfileSettings');

    Route::get('/user-last-active', '\App\Controllers\User\UserController@postLastActive');
    Route::get('/movie-editor', '\App\Controllers\User\UserController@movieEditor');
    Route::get('/movie-editor/{_token}', '\App\Controllers\User\UserController@getTokenInfo');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'web', 'admin']], function () {
    Route::post('/admin/post-upload-video', '\App\Controllers\User\AdminController@postUploadVideo');
    Route::get('/admin/user-list', '\App\Controllers\User\AdminController@userList');
    Route::get('/admin/group-list', '\App\Controllers\User\AdminController@groupList');
    Route::get('/admin/user-add', '\App\Controllers\User\AdminController@userAdd');
    Route::get('/admin/user-edit/{_user_id}', '\App\Controllers\User\AdminController@adminUserEdit');
    Route::get('/admin/video-edit/{_content_id}', '\App\Controllers\User\AdminController@contentEdit');
    Route::post('/admin/post-user-add', '\App\Controllers\User\AdminController@adminUserAdd');
    Route::get('/admin/content-list', '\App\Controllers\User\AdminController@contentList');
    Route::get('/admin/content-list-open', '\App\Controllers\User\AdminController@contentOpenList');
    Route::get('/admin/content-add', '\App\Controllers\User\AdminController@contentAdd');
    Route::post('/admin/post-content-add', '\App\Controllers\User\AdminController@contentAdd');
    Route::get('/admin/user-group-add', '\App\Controllers\User\AdminController@groupAdd');
    Route::get('/admin/user-to-group-add', '\App\Controllers\User\AdminController@userToGroupAdd');
    Route::get('/admin/user-to-group-add/{_group_id}', '\App\Controllers\User\AdminController@userToGroupAdd');

    Route::post('/admin/post-group-add', '\App\Controllers\User\AdminController@postGroupAdd');
    Route::post('/admin/post-user-group-add/{_group_id}', '\App\Controllers\User\AdminController@postUserToGroupAdd');

    Route::get('/admin/sorting-tag-add', '\App\Controllers\User\AdminController@sortingTagAdd');
    Route::post('/admin/post-sorting-tag-add', '\App\Controllers\User\AdminController@postSortingTagAdd');

    Route::get('/admin/group-edit/{_group_id}', '\App\Controllers\User\AdminController@editGroup');
    Route::get('/admin/location-list', '\App\Controllers\ContentController@adminLocationList');
    Route::get('/admin/ajax/approve-content/{_video_id}', '\App\Controllers\User\AdminController@approveContent');

    Route::get('/admin/map-generate', '\App\Controllers\User\AdminController@mapGenerate');
    Route::get('/admin/map-generate-list', '\App\Controllers\User\AdminController@mapGeneratedList');
    Route::post('/admin/post-map-generate', '\App\Controllers\User\AdminController@postMapGenerate');
    Route::get('/admin/map-generate/{_id}', '\App\Controllers\User\AdminController@editMapGenerate')->name('map-sharing.edit');

    Route::get('/admin/group-content-list/{_id}', '\App\Controllers\User\AdminController@groupContentList');
    Route::get('/admin/group-content-list-ajax/{_id}', '\App\Controllers\User\AdminController@groupContentListAjax');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'web', 'groupadmin']], function () {
//    Route::post('/group-admin/post-upload-video', '\App\Controllers\User\GroupAdminController@postUploadVideo');
    Route::get('/group-admin/user-list', '\App\Controllers\User\GroupAdminController@userList');
    Route::get('/group-admin/group-list', '\App\Controllers\User\GroupAdminController@groupList');
    Route::get('/group-admin/user-add', '\App\Controllers\User\GroupAdminController@userAdd');
    Route::get('/group-admin/user-edit/{_user_id}', '\App\Controllers\User\GroupAdminController@adminUserEdit');
    Route::get('/group-admin/video-edit/{_content_id}', '\App\Controllers\User\GroupAdminController@contentEdit');
    Route::post('/group-admin/post-user-add', '\App\Controllers\User\GroupAdminController@adminUserAdd');
    Route::get('/group-admin/content-list', '\App\Controllers\User\GroupAdminController@contentList');
//    Route::get('/group-admin/content-add', '\App\Controllers\User\GroupAdminController@contentAdd');
//    Route::post('/group-admin/post-content-add', '\App\Controllers\User\GroupAdminController@contentAdd');
    Route::get('/group-admin/user-group-add', '\App\Controllers\User\GroupAdminController@groupAdd');
    Route::get('/group-admin/user-to-group-add', '\App\Controllers\User\GroupAdminController@userToGroupAdd');
    Route::get('/group-admin/user-to-group-add/{_group_id}', '\App\Controllers\User\GroupAdminController@userToGroupAdd');
    Route::post('/group-admin/post-group-add', '\App\Controllers\User\GroupAdminController@postGroupAdd');
    Route::post('/group-admin/post-user-group-add/{_group_id}', '\App\Controllers\User\GroupAdminController@postUserToGroupAdd');
    Route::get('/group-admin/sorting-tag-add', '\App\Controllers\User\GroupAdminController@sortingTagAdd');
    Route::post('/group-admin/post-sorting-tag-add', '\App\Controllers\User\GroupAdminController@postSortingTagAdd');
    Route::get('/group-admin/group-edit/{_group_id}', '\App\Controllers\User\GroupAdminController@editGroup');
    Route::get('/group-admin/location-list', '\App\Controllers\ContentController@adminLocationList');

    Route::get('/group-admin/map-generate', '\App\Controllers\User\AdminController@mapGenerate');
    Route::get('/group-admin/map-generate-list', '\App\Controllers\User\AdminController@mapGeneratedList');
    Route::post('/group-admin/post-map-generate', '\App\Controllers\User\AdminController@postMapGenerate');
    Route::get('/group-admin/map-generate/{_id}', '\App\Controllers\User\AdminController@editMapGenerate');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'web', 'moderator']], function () {
    Route::get('/moderator/user-list', '\App\Controllers\User\ModeratorController@userList');
    Route::get('/moderator/group-list', '\App\Controllers\User\ModeratorController@groupList');
    Route::get('/moderator/user-add', '\App\Controllers\User\ModeratorController@userAdd');
    Route::get('/moderator/user-edit/{_user_id}', '\App\Controllers\User\ModeratorController@adminUserEdit');
    Route::get('/moderator/video-edit/{_content_id}', '\App\Controllers\User\ModeratorController@contentEdit');
    Route::post('/moderator/post-user-add', '\App\Controllers\User\ModeratorController@adminUserAdd');
    Route::get('/moderator/content-list', '\App\Controllers\User\ModeratorController@contentList');
//    Route::get('/moderator/content-add', '\App\Controllers\User\ModeratorController@contentAdd');
//    Route::post('/moderator/post-content-add', '\App\Controllers\User\ModeratorController@contentAdd');
//    Route::get('/group-admin/user-group-add', '\App\Controllers\User\GroupAdminController@groupAdd');
    Route::get('/moderator/user-to-group-add', '\App\Controllers\User\ModeratorController@userToGroupAdd');
    Route::get('/moderator/user-to-group-add/{_group_id}', '\App\Controllers\User\ModeratorController@userToGroupAdd');
//    Route::post('/group-admin/post-group-add', '\App\Controllers\User\GroupAdminController@postGroupAdd');
//    Route::post('/group-admin/post-user-group-add/{_group_id}', '\App\Controllers\User\GroupAdminController@postUserToGroupAdd');
    Route::get('/moderator/sorting-tag-add', '\App\Controllers\User\ModeratorController@sortingTagAdd');
    Route::post('/moderator/post-sorting-tag-add', '\App\Controllers\User\ModeratorController@postSortingTagAdd');
    Route::get('/moderator/group-edit/{_group_id}', '\App\Controllers\User\ModeratorController@editGroup');
//    Route::get('/group-admin/location-list', '\App\Controllers\ContentController@adminLocationList');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'web', 'user']], function () {
    Route::get('/user/video-edit/{_content_id}', '\App\Controllers\User\UserController@contentEdit');
    Route::get('/user/content-list', '\App\Controllers\User\UserController@contentList');
//    Route::get('/user/content-add', '\App\Controllers\User\UserController@contentAdd');
//    Route::post('/user/post-content-add', '\App\Controllers\User\UserController@contentAdd');
    Route::get('/user/sorting-tag-add', '\App\Controllers\User\UserController@sortingTagAdd');
    Route::post('/user/post-sorting-tag-add', '\App\Controllers\User\UserController@postSortingTagAdd');
});