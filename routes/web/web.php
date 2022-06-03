<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Pdf;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TypeaheadController;
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


Auth::routes(['verify'=>true]);

Route::get('/terms-and-conditions',function(){
    return view('terms-and-condition');
});
Route::get('/privacy-policy',function(){
    return view('privacy-policy');
});
Route::get('/contact-us', [ContactController::class, 'contact'])->name('contact');
Route::get('/autocomplete-search', [TypeaheadController::class, 'autocompleteSearch']);
Route::post('/send-message', [ContactController::class, 'sendEmail'])->name('contact.send');
Route::get('/search', [HomeController::class, 'search'])->name('search');
//Route::get('/search-autocomplete', [HomeController::class, 'autocomplete'])->name('search.autocomplete');
Route::get('/searchAll', [HomeController::class, 'searchAll'])->name('search.all');
Route::get('/search/{category_id}/category/{slug}', [HomeController::class, 'searchCategory'])->name('search.category');
Route::get('/search/year/{year}', [HomeController::class, 'searchYear'])->name('search.year');
Route::get('/search/{tag}/tag/{slug}', [HomeController::class, 'searchTag'])->name('search.tag');
Route::get('/post/{post}/title/{slug}', [PostController::class, 'show'])->name('post');


Route::middleware('auth')->group(function(){
    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index')->middleware('role:Admin');
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'activityLog'])->name('admin.activityLog')->middleware('role:Admin');
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['verified']);
    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
    Route::get('/posts/{post}/pdf', [Pdf::class, 'downloadpdf'])->name('pdf.download');
    Route::post('/pay/{post}', [PaymentController::class, 'pay'])->name('payment');
    Route::get('/success/{id}/{slug}', [PaymentController::class, 'success'])->name('success');
    Route::get('error', [PaymentController::class, 'error']);
});

