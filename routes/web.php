<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AddBookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\OrderBookController;
use App\Http\Controllers\SingleBookController;

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

Route::get('/', [BooksController::class, "index"])->name("home");
Route::get('/categories/{category:slug}', [BooksController::class, "index"])->name("category.show");

Route::get('/login', [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post('/login', [LoginController::class, "login"]);

Route::post('/logout', [LogoutController::class, "logout"])->name("logout");

Route::get('/category', [CategoryController::class, "index"])->name("category")->middleware("auth");
Route::post('/category', [CategoryController::class, "store"])->name("add.category")->middleware("auth");

Route::get('/book/{slug}', [SingleBookController::class, "index"])->name("single.book");
// Route::get('/download/{id}', [DownloadController::class, "index"])->name("download");

Route::get('/add-book', [AddBookController::class, "index"])->name("add.book")->middleware("auth");
Route::post('/add-book', [AddBookController::class, "store"])->name("store.or.fill.book")->middleware("auth");
Route::get('/edit-book/{book}', [AddBookController::class, "edit"])->name("edit.book")->middleware("auth");
Route::post('/update-book/{book}', [AddBookController::class, "update"])->name("update.book")->middleware("auth");
Route::post('/delete-book/{book}', [AddBookController::class, "delete"])->name("delete.book")->middleware("auth");


Route::get('/contact-us', [ContactController::class, "contact"])->name("contact");
Route::post('/contact-us', [ContactController::class, "sendEmail"]);

Route::get('/order-a-book', [OrderBookController::class, 'index'])->name('order.book');
Route::post('/books-orders-store', [OrderBookController::class, 'store'])->name('books.orders.store');
Route::get('/books-orders', [OrderBookController::class, 'showOrders'])->name('books.orders')->middleware("auth");
Route::post('/delete-order/{id}', [OrderBookController::class, 'delete'])->name('delete.order')->middleware("auth");
Route::post('/order-done/{id}', [OrderBookController::class, 'done'])->name('order.done')->middleware("auth");

