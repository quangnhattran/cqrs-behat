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

Route::get('/example', function () {
    return 'It works!';
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'posts', 'namespace' => 'Post'], function () {
    Route::get('/', 'PostController@index');
    Route::get('/{post}', 'PostController@show');
});
