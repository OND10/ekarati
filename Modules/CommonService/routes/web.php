<?php

use Illuminate\Support\Facades\Route;
use Modules\CommonService\Http\Controllers\CommonServiceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('commonservices', CommonServiceController::class)->names('commonservice');
});
