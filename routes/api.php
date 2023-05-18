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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:api'])->group(function () {
    /* Route::get('user', function (Request $request) {
        return $request->user();
    }); */
    Route::get('/user/show', [ProfileController::class, 'show']);
    Route::put('user/update', [ProfileController::class, 'update']);
    Route::delete('user/delete', [ProfileController::class, 'delete']);
//Route::get('/matches', [MatchesController::class, 'index']);

Route::post('logout', 'AuthController@logout');
});


/* Route::get('/matches', function () {
    return Matches::all();
}); */


