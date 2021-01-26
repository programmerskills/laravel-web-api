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

// Subchild category
Route::match(['get','post'],'/addchildcategory','ADMIN\SubchildcategoryController@addchildcategory')->name('addchildcategory');
Route::post('/subcategoryFromCategory','ADMIN\SubchildcategoryController@subcategoryFromCategory')->name('subcategoryFromCategory');
Route::get('/managechildcategory','ADMIN\SubchildcategoryController@managechildcategory')->name('managechildcategory');
Route::match(['get','post'],'/editchildcategory/{id}','ADMIN\SubchildcategoryController@editchildcategory')->name('editchildcategory');


//logout 
Route::post('/logout','Auth\LoginController@logout');

});


Auth::routes();
Route::get('/admin/dashboard', 'HomeController@index')->name('home');
?>