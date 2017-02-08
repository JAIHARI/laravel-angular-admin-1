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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', 'HomeController@index')->name('home');
Route::post('/authenticate', 'HomeController@authenticate')->name('authenticate');
Route::get('/register', 'HomeController@register')->name('register');
Route::post('/register', 'HomeController@register_user')->name('register_user');
