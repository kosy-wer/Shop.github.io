<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;
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

// routes/web.php atau routes/api.php
Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist'])->middleware('auth');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
