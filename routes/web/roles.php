<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
Route::post('/roles',[RoleController::class,'store'])->name('roles.store');
Route::delete('/roles/{role}/destroy',[RoleController::class,'destroy'])->name('roles.destroy');
Route::get('/roles/{role}/edit',[RoleController::class,'edit'])->name('roles.edit');
?>
