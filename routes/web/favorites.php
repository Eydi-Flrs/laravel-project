<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PermissionController;

use Illuminate\Support\Facades\Route;

Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorite.store');
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
Route::delete('/favorites/{id}/destroy', [favoriteController::class, 'destroy'])->name('favorite.destroy');
?>
