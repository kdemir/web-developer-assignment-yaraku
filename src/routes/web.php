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

Route::get('/', function () {return view('welcome');});
Route::resource('books', BookController::class);
Route::get('search','BookController@search')->name('books.search');
Route::post('books/exportCSV', 'BookController@exportToCsv')->name('books.exportCSV');
Route::post('books/exportXML', 'BookController@exportToXml')->name('books.exportXML');