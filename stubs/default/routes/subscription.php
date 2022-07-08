<?php

// Dashboard
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/dashboard', \App\Http\Livewire\Dashboard::class)->name('dashboard');

// Plans
Route::group(['namespace' => 'Subscriptions'], function () {
    Route::get('/plans', [\App\Http\Controllers\Subscriptions\PlanController::class, 'index'])->name('subscriptions.plans');
    Route::get('/subscriptions', [\App\Http\Controllers\Subscriptions\SubscriptionController::class, 'index'])->name('subscriptions');
    Route::post('/subscriptions', [\App\Http\Controllers\Subscriptions\SubscriptionController::class, 'store'])->name('subscriptions.store');
});

// Subscription and Account stuff
Route::group(['namespace' => 'Account', 'prefix' => 'account'], function () {

    Route::get('/', [\App\Http\Controllers\Account\AccountController::class, 'index'])->name('account');
    Route::get('/settings', [UserController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [UserController::class, 'update'])->name('settings.update');

    Route::group(['namespace' => 'Subscriptions', 'prefix' => 'subscriptions'], function () {
        Route::get('/', [\App\Http\Controllers\Account\Subscriptions\SubscriptionController::class, 'index'])->name('account.subscriptions');

        Route::get('/cancel', [\App\Http\Controllers\Account\Subscriptions\SubscriptionCancelController::class, 'index'])->name('account.subscriptions.cancel');
        Route::post('/cancel', [\App\Http\Controllers\Account\Subscriptions\SubscriptionCancelController::class, 'store'])->name('account.subscriptions.cancel');

        Route::get('/resume', [\App\Http\Controllers\Account\Subscriptions\SubscriptionResumeController::class, 'index'])->name('account.subscriptions.resume');
        Route::post('/resume', [\App\Http\Controllers\Account\Subscriptions\SubscriptionResumeController::class, 'store'])->name('account.subscriptions.resume');

        Route::get('/invoices', [\App\Http\Controllers\Account\Subscriptions\SubscriptionInvoiceController::class, 'index'])->name('account.subscriptions.invoices');
        Route::get('/invoices/{id}', [\App\Http\Controllers\Account\Subscriptions\SubscriptionInvoiceController::class, 'show'])->name('account.subscriptions.invoice');

        Route::get('/swap', [\App\Http\Controllers\Account\Subscriptions\SubscriptionSwapController::class, 'index'])->name('account.subscriptions.swap');
        Route::post('/swap', [\App\Http\Controllers\Account\Subscriptions\SubscriptionSwapController::class, 'store'])->name('account.subscriptions.swap');

        Route::get('/card', [\App\Http\Controllers\Account\Subscriptions\SubscriptionCardController::class, 'index'])->name('account.subscriptions.card');
        Route::post('/card', [\App\Http\Controllers\Account\Subscriptions\SubscriptionCardController::class, 'store'])->name('account.subscriptions.card');

        Route::get('/coupon', [\App\Http\Controllers\Account\Subscriptions\SubscriptionCouponController::class, 'index'])->name('account.subscriptions.coupon');
        Route::post('/coupon', [\App\Http\Controllers\Account\Subscriptions\SubscriptionCouponController::class, 'store'])->name('account.subscriptions.coupon');

    });
});