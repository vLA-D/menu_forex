<?php

use App\Http\Api\Controllers\CurrencyController;
use App\Http\Api\Controllers\OrderController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

Route::prefix('api')->withoutMiddleware(
    [ValidateCsrfToken::class, StartSession::class, ShareErrorsFromSession::class]
)->group(function () {

    // Admin endpoints
    Route::prefix('admin')->group(function () {
        Route::post('currencies/refresh', [CurrencyController::class, 'refresh'])->name('admin.currencies.refresh');
    });

    // Currency endpoints
    Route::prefix('currencies')->group(function () {
        Route::get('/', [CurrencyController::class, 'index'])
             ->name('currencies.index');
        Route::get('/{currency}', [CurrencyController::class, 'show'])
             ->name('currencies.show');
        Route::post('/{currency}/calculate', [CurrencyController::class, 'calculate'])
             ->name('currencies.calculate');
    });

    // Order endpoints
    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'store'])
            ->name('orders.store');
        Route::get('/{order}', [OrderController::class, 'show'])
            ->name('orders.show');
    });

});
