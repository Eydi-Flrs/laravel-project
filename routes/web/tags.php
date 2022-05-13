<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:Admin'])->group(function(){
Route::get('/tags',[TagController::class,'index'])->name('tags.index');
Route::post('/tags',[TagController::class,'store'])->name('tags.store');
Route::delete('/tags/{tag}/destroy', [TagController::class, 'destroy'])->name('tags.destroy');
Route::get('/tags/{tag}/edit',[TagController::class,'edit'])->name('tags.edit');
Route::put('/tags/{tag}/update',[TagController::class,'update'])->name('tags.update');
});
?>
