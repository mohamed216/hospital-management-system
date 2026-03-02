<?php

use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\appointments\AppointmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function() {

    // Home
    Route::get('/', function () {
        return view('welcome');
    });

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    // Auth Routes
    require __DIR__.'/auth.php';

    // Profile
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Dashboard Routes - Protected
    Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {

        // Patients
        Route::resource('patients', PatientController::class);

        // Doctors
        Route::resource('doctors', DoctorController::class);

        // Sections
        Route::resource('sections', SectionController::class);

        // Appointments
        Route::resource('appointments', AppointmentController::class);

        // Ambulances
        Route::resource('ambulances', AmbulanceController::class);

        // Insurance
        Route::resource('insurances', InsuranceController::class);

        // Services
        Route::resource('services', SingleServiceController::class);

        // Financial
        Route::resource('receipts', ReceiptAccountController::class);
        Route::resource('payments', PaymentAccountController::class);
    });
});
