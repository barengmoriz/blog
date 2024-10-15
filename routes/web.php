<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function (){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::middleware('can:Kategori')->get('category', [CategoryController::class, 'index'])->name('category');
        Route::middleware('can:Kategori Tambah')->get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::middleware('can:Kategori Tambah')->post('category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::middleware('can:Kategori Edit')->get('category/edit/{category:slug}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::middleware('can:Kategori Edit')->put('category/update/{category:slug}', [CategoryController::class, 'update'])->name('category.update');
        Route::middleware('can:Kategori Hapus')->delete('category/destroy/{category:slug}', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::middleware('can:Tag')->get('tag', [TagController::class, 'index'])->name('tag');
        Route::middleware('can:Tag Tambah')->get('tag/create', [TagController::class, 'create'])->name('tag.create');
        Route::middleware('can:Tag Tambah')->post('tag/store', [TagController::class, 'store'])->name('tag.store');
        Route::middleware('can:Tag Edit')->get('tag/edit/{tag:slug}', [TagController::class, 'edit'])->name('tag.edit');
        Route::middleware('can:Tag Edit')->put('tag/update/{tag:slug}', [TagController::class, 'update'])->name('tag.update');
        Route::middleware('can:Tag Hapus')->delete('tag/destroy/{tag:slug}', [TagController::class, 'destroy'])->name('tag.destroy');

        Route::middleware('can:Blog')->get('blog', [BlogController::class, 'index'])->name('blog');
        Route::middleware('can:Blog Tambah')->get('blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::middleware('can:Blog Tambah')->post('blog/store', [BlogController::class, 'store'])->name('blog.store');
        Route::middleware('can:Blog Edit')->get('blog/edit/{blog:slug}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::middleware('can:Blog Edit')->put('blog/update/{blog:slug}', [BlogController::class, 'update'])->name('blog.update');
        Route::middleware('can:Blog Hapus')->delete('blog/destroy/{blog:slug}', [BlogController::class, 'destroy'])->name('blog.destroy');
        
        Route::middleware('can:Blog Tayang')->put('blog/publish/{blog:slug}', [BlogController::class, 'publish'])->name('blog.publish');
        Route::middleware('can:Blog Tayang')->put('blog/unpublish/{blog:slug}', [BlogController::class, 'unpublish'])->name('blog.unpublish');

        Route::middleware('can:Pengguna')->get('user', [UserController::class, 'index'])->name('user');
        Route::middleware('can:Pengguna Tambah')->get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::middleware('can:Pengguna Tambah')->post('user/store', [UserController::class, 'store'])->name('user.store');
        Route::middleware('can:Pengguna Edit')->get('user/edit/{user:username}', [UserController::class, 'edit'])->name('user.edit');
        Route::middleware('can:Pengguna Edit')->put('user/update/{user:username}', [UserController::class, 'update'])->name('user.update');
        Route::middleware('can:Pengguna Hapus')->delete('user/destroy/{user:username}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::middleware('can:Pengguna Edit')->put('user/image/{user:username}', [UserController::class, 'imageUpload'])->name('user.image.upload');
        Route::middleware('can:Pengguna Edit')->delete('user/image/{user:username}', [UserController::class, 'imageDestroy'])->name('user.image.destroy');

        Route::middleware('can:Peran')->get('role', [RoleController::class, 'index'])->name('role');
        Route::middleware('can:Peran Tambah')->get('role/create', [RoleController::class, 'create'])->name('role.create');
        Route::middleware('can:Peran Tambah')->post('role/store', [RoleController::class, 'store'])->name('role.store');
        Route::middleware('can:Peran Edit')->get('role/edit/{role:name}', [RoleController::class, 'edit'])->name('role.edit');
        Route::middleware('can:Peran Edit')->put('role/update/{role:name}', [RoleController::class, 'update'])->name('role.update');
        Route::middleware('can:Peran Hapus')->delete('role/destroy/{role:name}', [RoleController::class, 'destroy'])->name('role.destroy');

        Route::middleware('can:Hak Akses')->get('permission', [PermissionController::class, 'index'])->name('permission');
        Route::middleware('can:Hak Akses Tambah')->get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::middleware('can:Hak Akses Tambah')->post('permission/store', [PermissionController::class, 'store'])->name('permission.store');
        Route::middleware('can:Hak Akses Edit')->get('permission/edit/{permission:name}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::middleware('can:Hak Akses Edit')->put('permission/update/{permission:name}', [PermissionController::class, 'update'])->name('permission.update');
        Route::middleware('can:Hak Akses Hapus')->delete('permission/destroy/{permission:name}', [PermissionController::class, 'destroy'])->name('permission.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function (){
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
        Route::put('profile/image', [ProfileController::class, 'imageUpload'])->name('profile.image.upload');
        Route::delete('profile/image', [ProfileController::class, 'imageDestroy'])->name('profile.image.destroy');
    });
});

require __DIR__.'/auth.php';
