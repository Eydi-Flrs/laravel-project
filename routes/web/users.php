<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function(){
    Route::get('/users',[UserController::class,'index'])->name('users.index');
    Route::put('/users/{user}/attach',[UserController::class,'attach'])->name('user.role.attach');
    Route::put('/users/{user}/detach',[UserController::class,'detach'])->name('user.role.detach');
    Route::get('users/{user}/profile',[UserController::class,'show'])->name('user.profile.show');
    Route::put('/users/{user}/update',[UserController::class,'update'])->name('user.profile.update');
    Route::delete('/users/{user}/destroy',[UserController::class,'destroy'])->name('user.destroy');
    Route::get('/users/archived',[UserController::class,'archived'])->name('user.archived');
    Route::put('/users/{user}/restore',[UserController::class,'restore'])->name('user.restore');
});
//
//Route::middleware(['can:view,user'])->group(function(){
//    Route::get('users/{user}/profile',[UserController::class,'show'])->name('user.profile.show');
//});

?>
