<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TasksController;

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index']);
    Route::resource('tasks', TasksController::class, [
        'only' => ['index', 'store', 'update', 'destroy']
    ]);
});
