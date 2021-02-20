<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
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

Route::get('/subir-imagen', [ImageController::class , 'create'])->name('image.create');
Route::post('image/save', [ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
Route::get('/image/{id}', [ImageController::class, 'detail'])->name('image.detail');

Route::post('/comment/save', [CommentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');