<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ShopController;

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

Route::get('shop', [ShopController::class, 'index']);

include __DIR__ . '/api/v1/admin.php';
include __DIR__ . '/api/v1/vendor.php';
include __DIR__ . '/api/v1/customer.php';
include __DIR__ . '/api/v1/staff.php';
