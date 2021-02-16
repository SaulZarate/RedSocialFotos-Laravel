<?php

use App\Http\Controllers\UserController;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/configuracion', [UserController::class, 'config'])->name('config');
Route::post('user/update', [UserController::class, 'update'])->name('user.update');
Route::get('user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');