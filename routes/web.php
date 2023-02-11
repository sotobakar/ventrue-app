<?php

use App\Http\Controllers\Organization\AuthController as OrganizationAuthController;
use App\Http\Controllers\Organization\DashboardController as OrganizationDashboardController;
use App\Http\Controllers\Organization\ProfileController as OrganizationProfileController;
use App\Http\Controllers\Organization\EventController as OrganizationEventController;
use App\Http\Controllers\Organization\ProposalController as OrganizationProposalController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;
use App\Http\Controllers\Student\AuthController as StudentAuthController;
use App\Http\Controllers\Student\EventController as StudentEventController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\OrganizationController as AdminOrganizationController;
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
Route::middleware(['not_student'])->group(function () {
    Route::get('/', [StudentHomeController::class, 'index'])->name('student.home');
    Route::get('/login', [StudentAuthController::class, 'loginPage'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'login']);

    Route::get('/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

    Route::get('/register', [StudentAuthController::class, 'registerPage'])->name('student.register');
    Route::post('/register', [StudentAuthController::class, 'register']);

    Route::prefix('/acara')->group(function () {
        Route::get('/', [StudentEventController::class, 'index'])->name('student.events');
        Route::get('/{event:id}', [StudentEventController::class, 'show'])->name('student.events.detail');

        Route::middleware(['student'])->group(function () {
            Route::post('/{event:id}/register', [StudentEventController::class, 'register'])->name('student.events.register');
        });
    });
});

Route::prefix('/mahasiswa')->middleware(['student'])->group(function () {
    Route::get('/acaraku', [StudentEventController::class, 'my_events'])->name('student.my_events');
    Route::get('/acaraku/{event:id}', [StudentEventController::class, 'my_event_detail'])->name('student.my_events.detail');

    Route::post('/acaraku/{event:id}/absensi', [StudentEventController::class, 'attend'])->name('student.my_events.attend');

    Route::post('/acaraku/{event:id}/feedback', [StudentEventController::class, 'submit_feedback'])->name('student.my_events.feedback');

    Route::post('/acaraku/{event:id}/ingatkan', [StudentEventController::class, 'remind'])->name('student.my_events.remind');

    Route::get('/saya', [StudentProfileController::class, 'index'])->name('student.profile');
    Route::get('/saya/verifikasi', [StudentProfileController::class, 'verifyPage'])->name('student.verify');
    Route::post('/saya/verifikasi', [StudentProfileController::class, 'verify']);
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

            // Download participants data to CSV
            Route::get('/{event:id}/participants/csv', [OrganizationEventController::class, 'participants_to_csv'])->name('organization.events.participants.csv');

            // Download attendees data to CSV
            Route::get('/{event:id}/attendees/csv', [OrganizationEventController::class, 'attendees_to_csv'])->name('organization.events.attendees.csv');

            // Download feedbacks data to CSV
            Route::get('/{event:id}/feedbacks/csv', [OrganizationEventController::class, 'feedbacks_to_csv'])->name('organization.events.feedbacks.csv');

            // Add Material
            Route::post('/{event:id}/materials', [OrganizationEventController::class, 'add_material'])->name('organization.events.materials.add');

            // Delete Material
            Route::delete('/{event:id}/materials/{material:id}', [OrganizationEventController::class, 'delete_material'])->name('organization.events.materials.delete');

            // Open Attendance
            Route::post('/{event:id}/open_attendance', [OrganizationEventController::class, 'open_attendance'])->name('organization.events.open_attendance');

            // Close Attendance
            Route::post('/{event:id}/close_attendance', [OrganizationEventController::class, 'close_attendance'])->name('organization.events.close_attendance');

            // Open Registration
            Route::post('/{event:id}/open_registration', [OrganizationEventController::class, 'open_registration'])->name('organization.events.open_registration');

            // Close Registration
            Route::post('/{event:id}/close_registration', [OrganizationEventController::class, 'close_registration'])->name('organization.events.close_registration');

            // Delete Event
        });

        // TODO: Proposal
        Route::prefix('/proposal')->group(function () {
            // Proposals List
            Route::get('/', [OrganizationProposalController::class, 'index'])->name('organization.proposals');

            // Buat proposal untuk acara yang sudah dibuat
            Route::get('/buat', [OrganizationProposalController::class, 'create'])->name('organization.proposals.create');

            // Buat proposal untuk acara yang sudah dibuat
            Route::post('/', [OrganizationProposalController::class, 'store']);

            // Edit Proposal
            Route::get('/{proposal}/ubah', [OrganizationProposalController::class, 'store']);

            // Kirim Proposal ke Email Penyetuju (Approve via JWT Token)

        });
    });
});

// Admin Section
Route::prefix('/admin')->group(function () {
    // Authentication
    Route::get('/login', [AdminAuthController::class, 'loginPage'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin'])->group(function () {
        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


        // List Ormawa


        // List Mahasiswa

        // Lihat konten landing page

        // Update konten landing page
        
    });



    // List Verifikasi Mahasiswa

    // Approve Verifikasi Mahasiswa

    // Tolak Verifikasi Mahasiswa

    // Halaman Penyetuju

    // Edit Penyetuju

    // Approve Proposal dan acara menjadi verified (via JWT Token)


});
