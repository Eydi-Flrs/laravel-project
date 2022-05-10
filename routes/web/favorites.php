<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PermissionController;

use Illuminate\Support\Facades\Route;

Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorite.store');

?>
