<?php

use App\Http\Controllers\API\V1\FormationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

// Route generé "api/v1/"

Route::prefix('/v1')->group(function () {
    Route::prefix("/formation")->group(function () {
        Route::get('/', [FormationController::class, 'index']);
        Route::get('/{id}', [FormationController::class, 'getById']);
        Route::post('/', [FormationController::class, 'store']);
    });
    Route::prefix("/auth")->group(function () {
        Route::post("register", RegisterController::class);
        Route::post("login", LoginController::class);
    });
});
