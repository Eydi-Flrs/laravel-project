<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth','role:Admin'])->group(function(){
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create')->middleware(['verifyCategoriesCount','verifyTagsCount']);
    Route::post('/posts', [PostController::class, 'store'])->name('post.store')->middleware(['verifyCategoriesCount','verifyTagsCount']);
    Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
    Route::patch('/posts/{post}/update', [PostController::class, 'update'])->name('post.update');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::get('/posts/archived',[PostController::class,'archived'])->name('post.archived');
    Route::put('/posts/{post}/restore',[PostController::class,'restore'])->name('post.restore');
    Route::delete('/posts/delete-checked',[PostController::class,'deleteCheckedPosts'])->name('post.deleteChecked');
});

?>
