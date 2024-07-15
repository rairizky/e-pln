<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect('auth/login');
});

// auth
Route::prefix('auth/')->name("auth.")->group(function() {
    Route::group(['middleware' => ['guest']], function() {
        Route::get('/login', [UserController::class, 'login'])->name('login');
        Route::post('/login', [UserController::class, 'post_login'])->name('post_login');
    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    });
});

// dashboard
Route::group(['middleware' => ['auth']], function() {
    Route::prefix('dashboard/')->name("dashboard.")->group(function() {

        // admin
        Route::group(['middleware' => ['role:admin']], function () {
            // customer
            Route::prefix('customer/')->name("customer.")->group(function() {
                // data
                Route::prefix('data/')->name("data.")->group(function() {
                    Route::get('/', [CustomerController::class, 'index'])->name('index');
                    Route::get('/create', [CustomerController::class, 'create'])->name('create');
                    Route::post('/create', [CustomerController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
                    Route::put('/edit/{id}', [CustomerController::class, 'update'])->name('update');
                    Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
                });

                // usage
                Route::prefix('usage/')->name("usage.")->group(function() {
                    Route::get('/', [UsageController::class, 'index'])->name('index');
                    Route::get('/create', [UsageController::class, 'create'])->name('create');
                    Route::post('/create', [UsageController::class, 'store'])->name('store');
                    Route::post('/bill/{id}', [UsageController::class, 'make_bill'])->name('make_bill');
                    Route::get('/edit/{id}', [UsageController::class, 'edit'])->name('edit');
                    Route::put('/edit/{id}', [UsageController::class, 'update'])->name('update');
                    Route::delete('/delete/{id}', [UsageController::class, 'delete'])->name('delete');
                });

                // bill
                Route::prefix('bill/')->name("bill.")->group(function() {
                    Route::get('/', [BillController::class, 'index'])->name('index');
                    Route::get('/{id}', [BillController::class, 'detail'])->name('detail');
                });
            });

            //  master
            Route::prefix('master/')->name("master.")->group(function() {
                // data
                Route::prefix('power/')->name("power.")->group(function() {
                    Route::get('/', [PowerController::class, 'index'])->name('index');
                    Route::get('/create', [PowerController::class, 'create'])->name('create');
                    Route::post('/create', [PowerController::class, 'store'])->name('store');
                    Route::get('/edit/{id}', [PowerController::class, 'edit'])->name('edit');
                    Route::put('/edit/{id}', [PowerController::class, 'update'])->name('update');
                    Route::delete('/delete/{id}', [PowerController::class, 'delete'])->name('delete');
                });
            });
        });

        // user

        // bill
        Route::group(['middleware' => ['role:user']], function () {
            Route::prefix('user/')->name("user.")->group(function() {
                Route::prefix('bill/')->name("bill.")->group(function() {
                    Route::get('/', [BillController::class, 'user_index'])->name('index');
                    Route::get('/pay/{id}', [BillController::class, 'pay_bill'])->name('pay');
                    Route::post('/pay/{id}', [BillController::class, 'paid_bill'])->name('paid');
                });
            });
        });
    });

});
