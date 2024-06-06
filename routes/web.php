<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
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

// 全員
Route::get('/', function () {
    return view('top');
});

// ログイン済み
Route::group(['middleware' => ['auth']], function () {
    Route::get('rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('rentals/create', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('rentals', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('rentals/{rental}', [RentalController::class, 'show'])->name('rentals.show');
    Route::get('rentals/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
    Route::patch('rentals/{rental}', [RentalController::class, 'update'])->name('rentals.update');
    Route::delete('rentals/{rental}', [RentalController::class, 'destroy'])->name('rentals.destroy');
    Route::patch('rentals/{rental}/return', [RentalController::class, 'return'])->name('rentals.return');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::get('books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('books', [BookController::class, 'store'])->name('books.store');
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    Route::get('carts', [CartController::class, 'index'])->name('carts.index');
    Route::post('carts', [CartController::class, 'store'])->name('carts.store');
    Route::delete('carts/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');

    Route::get('likes', [LikeController::class, 'index'])->name('likes.index');
    Route::post('likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('likes/{like}', [LikeController::class, 'destroy'])->name('likes.destroy');
});
