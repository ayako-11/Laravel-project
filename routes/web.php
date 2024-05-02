<?php
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\EditController;



Route::get('/search', SearchController::class);
Route::get('/save', SaveController::class);
Route::get('/edit', EditController::class);
