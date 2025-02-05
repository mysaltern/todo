<?php

use App\Http\Controllers\TodoController;

Route::get('/todo', [TodoController::class, 'index']);