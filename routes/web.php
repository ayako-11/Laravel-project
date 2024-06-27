<?php
declare(strict_types=1);

use App\Http\Controllers\SearchController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\EditformController;
use App\Http\Controllers\ChangeController;
use App\Http\Controllers\ChangeformController;
use App\Http\Controllers\TaskStartController;

Route::get('/search', [SearchController::class, '__invoke'])->name('search');
Route::get('/search-send', [IndexController::class, 'search'])->name('index.search');
Route::get('/', SaveController::class);
Route::post('/store', [CreateController::class, 'store'])->name('store');
Route::get('/edit/{id}', [EditformController::class, '__invoke'])->name('edit.form');
Route::post('/edit-post/{id}', [EditController::class, 'store'])->name('edit.post');
Route::get('/change/{id}', [ChangeformController::class, '__invoke'])->name('change.form');
Route::post('/change-post/{id}', [ChangeController::class, 'store'])->name('change.post');
Route::get('/tasks/{id}/start', [TaskStartController::class, 'startTask'])->name('tasks.start');
