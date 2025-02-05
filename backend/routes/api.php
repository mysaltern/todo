<?php

use App\Http\Controllers\TodoController;

Route::get('/todo', [TodoController::class, 'index']);
Route::post('/todo/store', [TodoController::class, 'store']);
