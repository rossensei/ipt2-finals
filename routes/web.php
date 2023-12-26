<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });



Route::middleware(['auth','verified'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/send-subscription-notification', [SubscriptionController::class, 'sendSubscriptionNotification']);

    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::get('/items/edit/{item}', [ItemController::class, 'edit'])->name('items.edit');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/delete/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
    Route::post('/items/buy/{item}', [ItemController::class, 'buy'])->name('items.buy');



    Route::get('/logs', [UserLogController::class, 'index']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);

    Route::get('/verification/{user}/{token}', [AuthController::class, 'verification']);
});

Route::get('/sendmail', [EmailController::class, 'sendEmail']);
