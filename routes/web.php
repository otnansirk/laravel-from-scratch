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

// Route::get('/about', function(){
//     return view('pages.about');
// });
// Route::get('/about/{name}/{id}', function($name, $id){
//     return 'my nane '.$name. 'with an id '. $id;
// });
// Route::get('/hello', function(){
//     return "hello";
// });

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/categories', 'PagesController@services');
Route::get('/lang/{lang}', 'PagesController@lang');

Route::resource('posts', 'PostController');


Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
