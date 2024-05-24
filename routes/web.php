<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminItemController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
route::get('admin/dashboard', [HomeController::class, 'index']);

Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
});

Route::resource('/items', ItemController::class);

Route::middleware(['auth', 'adminMiddleware'])->prefix('admin')->group(function () {
    Route::resource('/items', AdminItemController::class);
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user');
});
