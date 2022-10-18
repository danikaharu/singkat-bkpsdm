<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Route
Route::middleware(['auth', 'web'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // User
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Role & Permission
    Route::resource('roles', App\Http\Controllers\Admin\RoleAndPermissionController::class);

    Route::resource('settings', App\Http\Controllers\Admin\SettingController::class)->except('index', 'create', 'store', 'destroy', 'show');

    // Route::resource('promotions', App\Http\Controllers\Admin\PromotionController::class);
    Route::get('/promotion', [\App\Http\Controllers\Admin\PromotionController::class, 'index'])->name('promotion.index');
    Route::get('/listPromotion', [\App\Http\Controllers\Admin\PromotionController::class, 'getEmployee'])->name('promotion.getEmployee');
    Route::post('/promotion', [\App\Http\Controllers\Admin\PromotionController::class, 'store'])->name('promotion.store');
    Route::get('/promotion/{promotion}/edit', [\App\Http\Controllers\Admin\PromotionController::class, 'edit'])->name('promotion.edit');
    Route::put('/promotion/{promotion}/edit', [\App\Http\Controllers\Admin\PromotionController::class, 'update'])->name('promotion.update');
    Route::get('/promotion/step1', [\App\Http\Controllers\Admin\PromotionController::class, 'createStep1'])->name('promotion.step1');
    Route::post('/promotion/step1', [\App\Http\Controllers\Admin\PromotionController::class, 'storeStep1'])->name('promotion.storeStep1');
    Route::get('/promotion/step2', [\App\Http\Controllers\Admin\PromotionController::class, 'createStep2'])->name('promotion.step2');
    Route::post('/promotion/step2', [\App\Http\Controllers\Admin\PromotionController::class, 'storeStep2'])->name('promotion.storeStep2');
    Route::get('/promotion/step3', [\App\Http\Controllers\Admin\PromotionController::class, 'createStep3'])->name('promotion.step3');
    Route::post('/promotion/step3', [\App\Http\Controllers\Admin\PromotionController::class, 'storeStep3'])->name('promotion.storeStep3');
    Route::post('/promotion/verificator/{promotion}', [\App\Http\Controllers\Admin\PromotionController::class, 'storeVerificator'])->name('promotion.storeVerificator');
    Route::get('/promotion/{promotion}', [\App\Http\Controllers\Admin\PromotionController::class, 'show'])->name('promotion.show');
    Route::delete('/promotion/{promotion}', [\App\Http\Controllers\Admin\PromotionController::class, 'destroy'])->name('promotion.destroy');
    Route::get('/promotion/detail/{promotion}', [\App\Http\Controllers\Admin\PromotionController::class, 'detailApprove'])->name('promotion.detailApprove');
    Route::post('/promotion/detail/{promotion}', [\App\Http\Controllers\Admin\PromotionController::class, 'approve'])->name('promotion.approve');
    Route::get('promotion/detail/cancel/{promotion}', [\App\Http\Controllers\Admin\PromotionController::class, 'detailCancel'])->name('promotion.detailCancel');
    Route::post('promotion/detail/cancel/{promotion}', [\App\Http\Controllers\Admin\PromotionController::class, 'cancel'])->name('promotion.cancel');

    // Employee
    Route::get('/employee', [\App\Http\Controllers\Admin\EmployeeController::class, 'select'])->name('employee.select');
});

Route::get('/', function () {
    return view('auth.login');
});
