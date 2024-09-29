<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function (){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('category', [CategoryController::class, 'index'])->name('category');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('category/edit/{category:slug}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('category/update/{category:slug}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/destroy/{category:slug}', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::get('tag', [TagController::class, 'index'])->name('tag');
        Route::get('tag/create', [TagController::class, 'create'])->name('tag.create');
        Route::post('tag/store', [TagController::class, 'store'])->name('tag.store');
        Route::get('tag/edit/{tag:slug}', [TagController::class, 'edit'])->name('tag.edit');
        Route::put('tag/update/{tag:slug}', [TagController::class, 'update'])->name('tag.update');
        Route::delete('tag/destroy/{tag:slug}', [TagController::class, 'destroy'])->name('tag.destroy');

        Route::get('blog', [BlogController::class, 'index'])->name('blog');
        Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
        Route::get('blog/edit/{blog:slug}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('blog/update/{blog:slug}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('blog/destroy/{blog:slug}', [BlogController::class, 'destroy'])->name('blog.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
