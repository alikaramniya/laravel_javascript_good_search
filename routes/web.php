<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'post.',
    'prefix' => 'post',
    'controller' => PostController::class
], function() {
    Route::get('index', 'index')->name('index');
    Route::post('search', 'search')->name('search');
});

Route::get('/', function() {
    auth()->loginUsingId(1);

    return view('welcome');
});

Route::get('/post/gate', [PostController::class, 'gate'])->name('post.gate');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
