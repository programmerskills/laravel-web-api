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
Route::get('/d',function(){
    return view('admin.category.manage');
});
Route::middleware(['is_admin'])->group(function(){
    Route::get('/d',function(){
        return view('admin.category.manage');
    });
    Route::post('/logout','\Auth\LoginController@logout');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
