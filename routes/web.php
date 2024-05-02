<?php
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SaveController;



Route::get('/search', SearchController::class);
Route::get('/save', SaveController::class);