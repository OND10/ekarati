<?php

use Illuminate\Support\Facades\Route;
use Modules\Apartment\Http\Controllers\ApartmentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('apartments', ApartmentController::class)->names('apartment');
});
