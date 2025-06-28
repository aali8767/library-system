<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\RentalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
// إضافات مخصصة:
Route::get('/search/books', [BookController::class, 'search']);
Route::get('/books/category/{categoryId}', [BookController::class, 'booksByCategory']);
Route::get('/books/most-expensive', [BookController::class, 'mostExpensive']);
Route::get('/books/statistics', [BookController::class, 'statistics']);
Route::get('/books/latest', [BookController::class, 'latest']);

Route::apiResource('books', BookController::class);
