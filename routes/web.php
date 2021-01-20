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

Route::group(['prefix'=>'admin','middlware'=>['auth','is_admin']],function(){
// Route::get('/dashboard','ADMIN\DashboardController@index')->name('dashboard');

// category
Route::match(['get','post'],'/addcategory','ADMIN\CategoryController@addcategory')->name('addcategory');
Route::get('/managecategory','ADMIN\CategoryController@managecategory')->name('managecategory');
Route::match(['get','post'],'/editcategory/{id}','ADMIN\CategoryController@editcategory')->name('editcategory');

// subcategory
Route::match(['get','post'],'/addsubcategory','ADMIN\SubcategoryController@addsubcategory')->name('addsubcategory');
Route::get('/managesubcategory','ADMIN\SubcategoryController@managesubcategory')->name('managesubcategory');
Route::match(['get','post'],'/editsubcategory/{id}','ADMIN\SubcategoryController@editsubcategory')->name('editsubcategory');

//logout 
Route::post('/logout','\Auth\LoginController@logout');

});


Auth::routes();
Route::get('/admin/dashboard', 'HomeController@index')->name('home');
