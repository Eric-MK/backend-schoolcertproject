<?php

use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/user/{id}/show', [ProfileController::class, 'show']);
Route::put('/user/{id}/update', [ProfileController::class, 'update']);
Route::delete('/user/{id}/delete', [ProfileController::class, 'delete']);

Route::post('/tickets/purchase', [TicketController::class, 'purchase']);
Route::get('/tickets/{id}/tickets', [TicketController::class, 'userTickets']);
Route::delete('/tickets', [TicketController::class, 'delete']);

