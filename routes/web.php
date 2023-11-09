<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:60,1'])->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/post', [PostsController::class, 'index'])->name('post');
        Route::get('/post/{post:slug}', [PostsController::class, 'read'])->name('post.read'); // route model binding
        Route::get('/category', [CategoriesController::class, 'index'])->name('category');
        Route::get('/category/{category:category_name}', [CategoriesController::class, 'show'])->name('category.show');
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    });

    Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
        Route::middleware('admin')->group(function () {
            Route::resource('role', RoleController::class)->only(['index', 'store', 'update', 'destroy']);
            Route::resource('user', UserController::class)->only(['index', 'store', 'update', 'destroy']);
            Route::resource('category', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);
        });

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profil', [ProfilController::class, 'profil'])->name('profil');
        Route::put('/profil/{user}', [ProfilController::class, 'update'])->name('profil.update');
        Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
        Route::resource('post', PostController::class);
    });
});
