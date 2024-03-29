<?php

use App\Http\Controllers\Organization\AuthController as OrganizationAuthController;
use App\Http\Controllers\Organization\DashboardController as OrganizationDashboardController;
use App\Http\Controllers\Organization\ProfileController as OrganizationProfileController;
use App\Http\Controllers\Organization\EventController as OrganizationEventController;
use App\Http\Controllers\Organization\ApprovalController as OrganizationApprovalController;
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
use App\Http\Controllers\Admin\ApprovalController as AdminApprovalController;
use App\Http\Controllers\BiroUmum\AuthController as BiroUmumAuthController;
use App\Http\Controllers\BiroUmum\LocationController as BiroUmumLocationController;
use App\Http\Controllers\BiroUmum\DashboardController as BiroUmumDashboardController;
use App\Http\Controllers\BiroUmum\LocationScheduleController as BiroUmumLocationScheduleController;
use App\Http\Controllers\BiroAkpk\AuthController as BiroAkpkAuthController;
use App\Http\Controllers\BiroAkpk\ApprovalController as BiroAkpkApprovalController;
use App\Http\Controllers\BiroAkpk\DashboardController as BiroAkpkDashboardController;
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

    Route::get('/panduan', [StudentHomeController::class, 'help'])->name('student.help');
    Route::get('/login', [StudentAuthController::class, 'loginPage'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'login']);

    // OAuth2 Sign-in Redirect
    Route::get('/auth/{provider}/redirect', [StudentAuthController::class, 'redirect'])->name('student.login.oauth.redirect');

    // OAuth2 Callback
    Route::get('/auth/{provider}/callback', [StudentAuthController::class, 'callback'])->name('student.login.oauth.callback');

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

    Route::get('/acaraku/{event:id}/absensi/qr', [StudentEventController::class, 'attendWithQRCode'])->name('student.my_events.attend.qr');

    Route::post('/acaraku/{event:id}/feedback', [StudentEventController::class, 'submit_feedback'])->name('student.my_events.feedback');

    Route::post('/acaraku/{event:id}/ingatkan', [StudentEventController::class, 'remind'])->name('student.my_events.remind');

    Route::get('/saya', [StudentProfileController::class, 'index'])->name('student.profile');

    Route::put('/saya/gambar', [StudentProfileController::class, 'updateImage'])->name('student.profile.update_image');
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

            // Edit Event
            Route::get('/{event:id}/edit', [OrganizationEventController::class, 'edit'])->name('organization.events.edit');

            // Update Event
            Route::put('/{event:id}', [OrganizationEventController::class, 'update'])->name('organization.events.update');

            // Delete Event
            Route::delete('/{event:id}', [OrganizationEventController::class, 'delete'])->name('organization.events.delete');

            // Download participants data to CSV
            Route::get('/{event:id}/participants/csv', [OrganizationEventController::class, 'participants_to_csv'])->name('organization.events.participants.csv');

            // Download attendees data to CSV
            Route::get('/{event:id}/attendees/csv', [OrganizationEventController::class, 'attendees_to_csv'])->name('organization.events.attendees.csv');

            // Download participants data to PDF
            Route::get('/{event:id}/participants/pdf', [OrganizationEventController::class, 'participants_to_pdf'])->name('organization.events.participants.pdf');

            // Download attendees data to PDF
            Route::get('/{event:id}/attendees/pdf', [OrganizationEventController::class, 'attendees_to_pdf'])->name('organization.events.attendees.pdf');

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

            // Update Certificate Link
            Route::post('/{event:id}/certificate', [OrganizationEventController::class, 'update_certificate_link'])->name('organization.events.certificate');
        });

        Route::prefix('/persetujuan')->group(function () {
            Route::get('/', [OrganizationApprovalController::class, 'index'])->name('organization.approvals');

            Route::get('/buat', [OrganizationApprovalController::class, 'create'])->name('organization.approvals.create');

            Route::post('/', [OrganizationApprovalController::class, 'store']);

            Route::get('/{approval}', [OrganizationApprovalController::class, 'show'])->name('organization.approvals.detail');

            Route::post('/{approval}/send', [OrganizationApprovalController::class, 'send'])->name('organization.approvals.send');
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
        Route::get('/ormawa', [AdminOrganizationController::class, 'index'])->name('admin.organizations');

        // Form Create Ormawa
        Route::get('/ormawa/buat', [AdminOrganizationController::class, 'create'])->name('admin.organizations.create');

        // Detail Ormawa
        Route::get('/ormawa/{organization}', [AdminOrganizationController::class, 'show'])->name('admin.organizations.detail');

        // Create Ormawa
        Route::post('/ormawa', [AdminOrganizationController::class, 'store']);

        // Form Edit Ormawa
        Route::get('/ormawa/{organization}/edit', [AdminOrganizationController::class, 'edit'])->name('admin.organizations.edit');

        // Update Ormawa
        Route::put('/ormawa/{organization}', [AdminOrganizationController::class, 'update'])->name('admin.organizations.update');

        // Hapus Ormawa
        Route::delete('/ormawa/{organization}', [AdminOrganizationController::class, 'delete'])->name('admin.organizations.delete');

        // List Mahasiswa
        Route::get('/mahasiswa', [AdminStudentController::class, 'index'])->name('admin.students');

        // Form Edit Mahasiswa
        Route::get('/mahasiswa/{student}/edit', [AdminStudentController::class, 'edit'])->name('admin.students.edit');

        // Update Mahasiswa
        Route::put('/mahasiswa/{student}', [AdminStudentController::class, 'update'])->name('admin.students.update');

        // Hapus Mahasiswa
        Route::delete('/mahasiswa/{student}', [AdminStudentController::class, 'delete'])->name('admin.students.delete');

        Route::prefix('/acara')->group(function () {
            // List Acara
            Route::get('/', [AdminEventController::class, 'index'])->name('admin.events');

            // Edit Event
            Route::get('/find', [AdminEventController::class, 'find'])->name('admin.events.find');

            // Edit Event
            Route::get('/{event:id}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');

            // Update Event
            Route::put('/{event:id}', [AdminEventController::class, 'update'])->name('admin.events.update');

            // Delete Event
            Route::delete('/{event:id}', [AdminEventController::class, 'delete'])->name('admin.events.delete');
        });

        // Lihat konten landing page
        Route::get('/konten', [AdminContentController::class, 'index'])->name('admin.content');

        // Update konten landing page
        Route::put('/konten/{content}', [AdminContentController::class, 'update'])->name('admin.content.update');

        // Halaman Email Penyetuju
        Route::get('/penyetuju', [AdminApprovalController::class, 'approvers_list'])->name('admin.approvers');

        // Update penyetuju
        Route::put('/penyetuju/{approver}', [AdminApprovalController::class, 'update_approver'])->name('admin.approvers.update');

        // Setuju Proposal (URL dari email)
        Route::get('/persetujuan/{approval}', [AdminApprovalController::class, 'approve'])->name('admin.approvals.approve')->withoutMiddleware(['admin']);
    });
});

// Biro Umum Section
Route::prefix('/biroumum')->group(function () {
    // Authentication
    Route::get('/login', [BiroUmumAuthController::class, 'loginPage'])->name('biroumum.login');
    Route::post('/login', [BiroUmumAuthController::class, 'login']);
    Route::get('/logout', [BiroUmumAuthController::class, 'logout'])->name('biroumum.logout');

    Route::middleware(['biroumum'])->group(function () {
        Route::get('/', [BiroUmumDashboardController::class, 'dashboard'])->name('biroumum.dashboard');

        // List Lokasi
        Route::get('/lokasi', [BiroUmumLocationController::class, 'index'])->name('biroumum.locations');

        // Form Create Lokasi
        Route::get('/lokasi/buat', [BiroUmumLocationController::class, 'create'])->name('biroumum.locations.create');

        // Detail Lokasi
        Route::get('/lokasi/{location}', [BiroUmumLocationController::class, 'show'])->name('biroumum.locations.detail');

        // Create Lokasi
        Route::post('/lokasi', [BiroUmumLocationController::class, 'store']);

        // Form Edit Lokasi
        Route::get('/lokasi/{location}/edit', [BiroUmumLocationController::class, 'edit'])->name('biroumum.locations.edit');

        // Update Lokasi
        Route::put('/lokasi/{location}', [BiroUmumLocationController::class, 'update'])->name('biroumum.locations.update');

        // Hapus Lokasi
        Route::delete('/lokasi/{location}', [BiroUmumLocationController::class, 'delete'])->name('biroumum.locations.delete');

        Route::prefix('/jadwal_bentrok')->group(function () {
            // List Jadwal di Ruangan
            Route::get('/', [BiroUmumLocationScheduleController::class, 'index'])->name('biroumum.schedules.clash');
        });
    });
});

// Biro AKPK Section
Route::prefix('/biroakpk')->group(function () {
    // Authentication
    Route::get('/login', [BiroAkpkAuthController::class, 'loginPage'])->name('biroakpk.login');
    Route::post('/login', [BiroAkpkAuthController::class, 'login']);
    Route::get('/logout', [BiroAkpkAuthController::class, 'logout'])->name('biroakpk.logout');

    Route::middleware(['biroakpk'])->group(function () {
        Route::get('/', [BiroAkpkDashboardController::class, 'dashboard'])->name('biroakpk.dashboard');

        Route::prefix('/persetujuan')->group(function () {
            // List Acara yang belum disetujui
            Route::get('/', [BiroAkpkApprovalController::class, 'index'])->name('biroakpk.approvals');

            Route::post('/{event:id}/approve', [BiroAkpkApprovalController::class, 'approve'])->name('biroakpk.approvals.approve');

            Route::get('/{event:id}', [BiroAkpkApprovalController::class, 'detail'])->name('biroakpk.approvals.detail');
        });
    });
});
