<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/api/books', [BookController::class, 'getData'])->name('books.data');
Route::post('/api/books', [BookController::class, 'store'])->name('books.store');
Route::put('/api/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/api/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
