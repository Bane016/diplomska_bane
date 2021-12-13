<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

    Route::get('/all_ads', 'AdsController@allAds')->name('all.ads');

Route::prefix('/user')->group(function () {

    Route::get('/home', 'HomeController@index')->name('user.home');
    Route::get('/profile', 'UserController@profile')->name('user.profile')->middleware('auth');
    Route::post('/edit-user-profile', 'UserController@editProfile')->name('user.edit-profile')->middleware('auth');
    Route::get('/settings','UserController@settings')->name('user.settings');

    Route::get('/ads', 'AdsController@allBids')->name('all.bids');
    Route::get('/my-bids', 'AdsController@myBids')->name('user.my.bids');
    Route::post('add-ads', 'UserController@addAds')->name('user.add.ad');
    Route::post('get-ad-info', 'UserController@getAdInfo')->name('user.get.ad.info');
    Route::post('edit-ads', 'UserController@editAds')->name('user.edit.ads');
    Route::post('delete-ads', 'UserController@deleteAds')->name('user.delete.ads');


});

Route::prefix('/admin')->group(function () {

    // Admin Login
    Route::get('/login','AdminLoginController@login')->name('admin.login');
    Route::post('/login','AdminLoginController@login_submit')->name('admin.login.submit');
    Route::post('/logout','AdminLoginController@logout')->name('admin.logout');

    // Admin Home Page
    Route::get('/home', 'AdminController@home')->name('admin.home');

    Route::get('/users', 'AdminController@users')->name('admin.users');
    Route::post('/get-users', 'AdminController@allUsers')->name('admin.get.users');
    Route::post('/delete-user', 'AdminController@deleteUser')->name('admin.user.delete');
    Route::get('/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/admin-ads', 'AdminController@allAds')->name('admin.all.ads');
    Route::post('/delete-ads', 'AdminController@deleteAds')->name('admin.delete.ads');
    Route::post('/edit-admin-profile', 'AdminController@editAdminProfile')->name('admin.edit-profile')->middleware('auth');


});
