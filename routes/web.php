<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('boards', BoardController::class);
    Route::resource('boards.tasks', TaskController::class)->shallow();
    Route::resource('tasks.comments', CommentController::class)->only(['store', 'destroy']);

    Route::get('/tasks', [TaskController::class, 'allTasks'])->name('tasks.index');
    Route::patch('tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

});