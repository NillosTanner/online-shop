<?php

use App\Http\Controllers\Api\V1\Admin\ShopController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => ['auth:sanctum'],
], function () {
    Route::apiResource('shops', ShopController::class);
});
