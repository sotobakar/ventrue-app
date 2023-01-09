<?php

use App\Http\Controllers\Organization\AuthController as OrganizationAuthController;
use App\Http\Controllers\Organization\DashboardController as OrganizationDashboardController;
use App\Http\Controllers\Organization\ProfileController as OrganizationProfileController;
use App\Http\Controllers\Organization\EventController as OrganizationEventController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;
use App\Http\Controllers\Student\AuthController as StudentAuthController;
use App\Http\Controllers\Student\EventController as StudentEventController;
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

// Front-facing / Student Section
Route::get('/', [StudentHomeController::class, 'index'])->name('student.home');
Route::get('/login', [StudentAuthController::class, 'loginPage'])->name('student.login');
Route::post('/login', [StudentAuthController::class, 'login']);

Route::get('/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

Route::get('/register', [StudentAuthController::class, 'registerPage'])->name('student.register');
Route::post('/register', [StudentAuthController::class, 'register']);

Route::prefix('/acara')->group(function () {
    // TODO: List of events
    Route::get('/', [StudentEventController::class, 'index'])->name('student.events');
    // TODO: Show event detail
    Route::get('/{event:id}', [StudentEventController::class, 'show'])->name('student.events.detail');

    // TODO: Register for an event
    Route::middleware(['student'])->group(function () {
        Route::post('/{event:id}/register', [StudentEventController::class, 'register'])->name('student.events.register');
        Route::post('/{event:id}/remind', [StudentEventController::class, 'remind'])->name('student.events.remind');
    });
});

Route::prefix('/mahasiswa')->group(function () {
    Route::middleware(['student'])->group(function () {
        Route::get('/acaraku', [StudentEventController::class, 'my_events'])->name('student.my_events');
        Route::get('/acaraku/{event:id}', [StudentEventController::class, 'my_event_detail'])->name('student.my_events.detail');
    });
});

// Organization Section
Route::prefix('/ormawa')->group(function () {
    // Authentication
    Route::get('/login', [OrganizationAuthController::class, 'loginPage'])->name('organization.login');
    Route::post('/login', [OrganizationAuthController::class, 'login']);
    Route::get('/logout', [OrganizationAuthController::class, 'logout'])->name('organization.logout');

    Route::middleware(['organization'])->group(function () {
        // Dashboard
        Route::get('/', [OrganizationDashboardController::class, 'index'])->name('organization.dashboard');

        // Account/Profile
        Route::prefix('/profil')->group(function () {
            Route::get('/', [OrganizationProfileController::class, 'index'])->name('organization.profile');

            // Update profile data
            Route::put('/', [OrganizationProfileController::class, 'update']);
        });

        // Event
        Route::prefix('/acara')->group(function () {
            Route::get('/', [OrganizationEventController::class, 'index'])->name('organization.events');

            // Create Event
            Route::get('/buat', [OrganizationEventController::class, 'create'])->name('organization.events.create');
            Route::post('/', [OrganizationEventController::class, 'store']);

            // Event Details
            Route::get('/{event:id}', [OrganizationEventController::class, 'show'])->name('organization.events.detail');

            // Delete Event

            // Get Registered Users
        });

        // TODO: Proposal
        Route::prefix('/proposal')->group(function () {
            // Upload proposal untuk acara yang sudah dibuat
            Route::get('/', [OrganizationEventController::class, 'index'])->name('organization.proposals');

            // Kirim Proposal ke Email Wakil Dekan/Dekanat

            // Approve Proposal dan acara menjadi verified
        });
    });

    // TODO: Set up middleware
});

// Admin Section
