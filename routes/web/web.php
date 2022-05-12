<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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


Auth::routes();


Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/search/category/{category_id}', [HomeController::class, 'searchCategory'])->name('search.category');
Route::get('/search/year/{year}', [HomeController::class, 'searchYear'])->name('search.year');
Route::get('/search/tag/{tag}', [HomeController::class, 'searchTag'])->name('search.tag');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post');


Route::middleware('auth')->group(function(){
    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index')->middleware('role:ADMIN');
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

