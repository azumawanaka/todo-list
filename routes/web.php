<?php

use App\Http\Controllers\Api\TasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

Route::get('/admin/login', function() {
    return view('/auth/admin/login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'can:user']], function () {
    Route::get('', [HomeController::class, 'index'])->name('user.home');
    Route::resource('tasks', TasksController::class);
});

Route::group(['middleware' => ['auth', 'can:admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
});
