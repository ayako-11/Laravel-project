<?php
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\ChangeController;



Route::get('/search', SearchController::class);
Route::get('/save', SaveController::class);
Route::get('/edit', EditController::class);
Route::get('/change', ChangeController::class);
