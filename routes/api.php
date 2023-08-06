<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::post('/sanctum/token', [TokenController::class, 'token'])->name('token');

Route::middleware('auth:sanctum')->post('/daysheets', [DataController::class, 'daysheets'])->name('api-daysheets');
Route::middleware('auth:sanctum')->get('/clients', [DataController::class, 'clients'])->name('api-clients');
