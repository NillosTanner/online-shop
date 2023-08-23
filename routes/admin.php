<?php

use App\Http\Controllers\Admin\ShopController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => ['auth'],
], function () {
    Route::resource('/shops', ShopController::class);
});
