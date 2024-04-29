<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('profile/user', [ProfileController::class, 'user'])->name('profile.user');

Route::get('/', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/', [ProfileController::class, 'store'])->name('profile.store');

Route::group([
    'as' => 'post',
    'prefix' => 'post',
    'controller' => PostController::class,
], function () {
    Route::post('/search', 'search');
    Route::get('/localization', 'localization')->name('localization');
    Route::get('/cache', 'cache')->name('cache');
    Route::get('/', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/list', 'listPost')->name('index');
    Route::get('/show/list', 'index')->name('index');
    Route::get('/comment', 'comments')->name('comments');
    Route::get('/uploader', 'uploader')->name('uploader');
    Route::get('/user', 'user')->name('user');
    Route::get('/test', 'test')->name('test');
});

Route::get('tag/posts', [TagController::class, 'posts'])->name('tag.post');
