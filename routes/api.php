<?php

use App\Http\Controllers\StoreUserController;
use App\Http\Controllers\StoreWalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['validate.transaction'])->group(function () {

    Route::post('/users', StoreUserController::class)->name('user.store');

    Route::post('/wallets', StoreWalletController::class)->name('wallet.store');

    Route::post('/transfer', StoreWalletController::class)->name('wallet.transfer');

});
