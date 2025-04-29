<?php

use Illuminate\Support\Facades\Route;
use Modules\Apartment\Http\Controllers\ApartmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('apartments', ApartmentController::class)->names('apartment');
});
