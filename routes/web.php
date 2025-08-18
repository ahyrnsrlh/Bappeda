<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingScheduleController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserApprovalController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Team;

// Landing page - show welcome page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'teams' => Team::all()
    ]);
})->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Meeting Schedules
    Route::prefix('meetings')->group(function () {
        Route::get('/', [MeetingScheduleController::class, 'index'])->name('meetings.index');
        Route::get('/create', [MeetingScheduleController::class, 'create'])
            ->middleware('role:KI')
            ->name('meetings.create');
        Route::post('/', [MeetingScheduleController::class, 'store'])
            ->middleware('role:KI')
            ->name('meetings.store');
        Route::get('/{meeting}', [MeetingScheduleController::class, 'show'])->name('meetings.show');
        Route::get('/{meeting}/edit', [MeetingScheduleController::class, 'edit'])
            ->middleware('role:KI')
            ->name('meetings.edit');
        Route::put('/{meeting}', [MeetingScheduleController::class, 'update'])
            ->middleware('role:KI')
            ->name('meetings.update');
        Route::delete('/{meeting}', [MeetingScheduleController::class, 'destroy'])
            ->middleware('role:KI')
            ->name('meetings.destroy');
    });
    
    // Teams
    Route::prefix('teams')->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('teams.index');
        Route::get('/{team}/files', [TeamController::class, 'files'])->name('teams.files');
        Route::get('/{team}/folders/{folder}', [TeamController::class, 'showFolder'])->name('teams.folders');
    });
    
    // File Management
    Route::prefix('file-management')->group(function () {
        Route::get('/create', [FileController::class, 'create'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5,tim_kemiskinan,tim_industri_psn,tim_investasi,tim_csr,tim_dbh')
            ->name('files.create');
        Route::post('/', [FileController::class, 'store'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5,tim_kemiskinan,tim_industri_psn,tim_investasi,tim_csr,tim_dbh')
            ->name('files.store');
        Route::get('/{file}', [FileController::class, 'show'])->name('files.show');
        Route::get('/{file}/edit', [FileController::class, 'edit'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5,tim_kemiskinan,tim_industri_psn,tim_investasi,tim_csr,tim_dbh')
            ->name('files.edit');
        Route::put('/{file}', [FileController::class, 'update'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5,tim_kemiskinan,tim_industri_psn,tim_investasi,tim_csr,tim_dbh')
            ->name('files.update');
        Route::get('/{file}/download', [FileController::class, 'download'])->name('files.download');
        Route::delete('/{file}', [FileController::class, 'destroy'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5,tim_kemiskinan,tim_industri_psn,tim_investasi,tim_csr,tim_dbh')
            ->name('files.destroy');
    });
    
    // Files index route (Kelola File from dashboard)
    Route::get('/files', [FileController::class, 'index'])
        ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5,tim_kemiskinan,tim_industri_psn,tim_investasi,tim_csr,tim_dbh,kabid')
        ->name('files.index');

    // User Approval (Kepala Bidang only)
    Route::middleware('role:kabid')->group(function () {
        Route::get('/user-approval', [UserApprovalController::class, 'index'])->name('user-approval.index');
        Route::post('/user-approval/update', [UserApprovalController::class, 'update'])->name('user-approval.update');
        Route::post('/user-approval/revoke', [UserApprovalController::class, 'revoke'])->name('user-approval.revoke');
    });
});
