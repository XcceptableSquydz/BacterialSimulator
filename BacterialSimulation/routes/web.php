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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/account', 'AccountController@index')->name('account');
Route::get('/edit_account', 'EditAccountController@index')->name('edit_account');
Route::get('/home', 'HomeController@index')->name('home');
