<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/questions', [\App\Http\Controllers\Api\QuestionController::class, 'store'])->name('questions.store');
Route::post('/questions/storeOrUpdate', [\App\Http\Controllers\Api\QuestionController::class, 'storeOrUpdate']);
Route::post('/questions/storeOrUpdateBukInsert', [\App\Http\Controllers\Api\QuestionController::class, 'storeOrUpdateBukInsert']);

Route::post('/users', [\App\Http\Controllers\Api\UserController::class, 'store'])->name('users.store');
Route::put('/users/{user}', [\App\Http\Controllers\Api\UserController::class, 'update'])->name('users.update');
