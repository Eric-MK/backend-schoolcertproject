<?php

use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\ProfileController;

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

Route::match(['GET', 'POST'], '/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

// Remove the 'auth:api' middleware group from here

// Add the 'auth:api' middleware to individual routes that require authentication
Route::middleware(['auth:api'])->group(function () {
    Route::get('/user/show', [ProfileController::class, 'show']);
    Route::put('user/update', [ProfileController::class, 'update']);
    Route::delete('user/delete', [ProfileController::class, 'delete']);
    // Add other authenticated routes here
});

// Add a catch-all route for other API routes
Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});
