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

Route::get('/home', 'HomeController@index')->name('home');

//City routes
Route::middleware(['auth:web'])->group(function () {
Route::get('/city-list', 'CityController@list')->name('city-list');
Route::get('/city-add', 'CityController@add')->name('city-add');
Route::get('/city-search', 'CityController@search')->name('city-search');
Route::get('/city-delete/{id}', 'CityController@delete')->name('city-delete');
Route::get('/city-edit/{id}', 'CityController@edit')->name('city-edit');
Route::post('/city-manage', 'CityController@manage')->name('city-manage');
Route::post('/city-search-manage', 'CityController@searchmanage')->name('city-search-manage');
});

