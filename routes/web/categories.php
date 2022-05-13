<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:Admin'])->group(function(){
Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{category}/edit',[CategoryController::class,'edit'])->name('categories.edit');
Route::put('/categories/{category}/update',[CategoryController::class,'update'])->name('categories.update');
});
?>
