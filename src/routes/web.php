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

// use App\Http\Controllers\BookController;

Route::resource('books', BookController::class);
// Route::get('books', [BookController::class, 'index'])->name('books.index');
// Route::post('books', [BookController::class, 'store'])->name('books.store');
// Route::delete('books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
// Route::get('books/{book}/edit', [BookController::class, 'update'])->name('books.update');