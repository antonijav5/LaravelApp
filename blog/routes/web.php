<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post routes
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('can:create-post');;
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('can:create-post');;
    
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('can:update-post,post');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('can:update-post,post');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('can:update-post,post');

    // Comment routes
    // We have an edge case here: what happens when the comment owner is a guest? Just in case, we won't allow deleting in that case.
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::post('/posts/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

require __DIR__.'/auth.php';
