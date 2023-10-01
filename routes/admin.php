<?php

/**
 * This is for admin route
 */

use App\Http\Controllers\Auth\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::post('/auth', LoginController::class);
});
