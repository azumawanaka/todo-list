<?php

use App\Http\Controllers\Api\TasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index']);
    Route::resource('tasks', TasksController::class);
});
