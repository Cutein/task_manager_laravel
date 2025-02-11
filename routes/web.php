<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/boards.index', function () {
        return view('boards.index');
    })->name('boards.index');
    Route::get('/tasks.index', function () {
        return view('tasks.index');
    })->name('tasks.index');
});
