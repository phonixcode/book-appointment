<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;

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

// Route::get('/', function () {
//     return view('user.pages.dashboard');
// });


/*User route*/
Route::name('user.')->group(function () {

    Route::middleware(['guest:web', 'prevent.back.history'])->group(function () {
        Route::view('login', 'user.auth.login')->name('login');
        Route::post('login', [UserController::class, 'loginSubmit'])->name('login.submit');

        Route::view('register', 'user.auth.register')->name('register');
        Route::post('register', [UserController::class, 'registerSubmit'])->name('register.submit');
    });

    Route::middleware(['auth:web', 'prevent.back.history'])->group(function () {
        Route::get('/', [AppointmentController::class, 'appointmentList'])->name('home');
        Route::get('appointment/create', [AppointmentController::class, 'appointmentCreate'])->name('appointment.create');
        Route::post('appointment/create', [AppointmentController::class, 'appointmentStore'])->name('appointment.store');
        Route::get('appointment/check-slot/{id}', [AppointmentController::class, 'checkSlots'])->name('appointment.check.slot');
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
    });
});

/*Admin route*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin', 'prevent.back.history'])->group(function () {
        Route::view('login', 'admin.auth.login')->name('login');
        Route::post('login', [AdminController::class, 'loginSubmit'])->name('login.submit');
    });

    Route::middleware(['auth:admin', 'prevent.back.history'])->group(function () {
        Route::get('/', [AppointmentController::class, 'appointment'])->name('home');
        Route::post('appointment/edit', [AppointmentController::class, 'appointmentStoreEdit'])->name('appointment.store.edit');

        Route::view('settings', 'admin.pages.setting')->name('settings');
        Route::post('settings', [AppointmentController::class, 'appointmentsSettingsStore'])->name('settings.store');

        Route::post('logout', [AdminController::class, 'logout'])->name('logout');
    });
});
