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
//     return view('welcome');
// });
Route::get('/', 'VideosController@index');

Route::get('/contact', 'PagesController@contact'); 
/* dodaje stronę kontakt po wywołaniu controllera PagesController */

Route::get('/about', 'PagesController@about');



Route::group(['middleware' => ['web']], function () {
	/*Route::post('/videos', 'VideosController@store');
	Route::get('/videos', 'VideosController@index');
	Route::get('/videos/create', 'VideosController@create');
	Route::get('/videos/{id}', 'VideosController@show');*/
	Route::resource('videos','VideosController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
