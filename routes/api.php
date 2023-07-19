<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
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

    Route::post('/users', [UserController::class, 'store'])->name('user.store');

    Route::post('/wallets', [WalletController::class, 'store'])->name('wallet.store');
    Route::get('/wallets', [WalletController::class, 'show'])->name('wallet.show');

    Route::post('/transfer', [WalletController::class, 'transfer'])->name('wallet.transfer');

});
