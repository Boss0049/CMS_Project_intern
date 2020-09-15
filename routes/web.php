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

Route::get('/home', function() {
	return view('home');	
})->name('home');


Route::resource('test','PostController');
Route::get('tests', 'PostController@getAll');

Route::get('Boss', function () {
    return ['laravel' , 'vue'];
});

Route::post('saveImg','PostController@saveImg');
Route::get('/file/saveEdit','PostController@saveEdit');
Route::post('saveEdit','PostController@saveEdit');
Route::get('edit','PostController@testedit');
Route::put('update/{id}','PostController@updatestatus');
Route::put('autosave/{id}','PostController@autosave');
Route::get('lastid/{id}/edit','PostController@lastid');
