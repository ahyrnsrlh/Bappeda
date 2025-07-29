<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingScheduleController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MeetingNoteController;
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
    
    // Meeting Notes
    Route::prefix('meeting-notes')->group(function () {
        Route::get('/', [MeetingNoteController::class, 'index'])->name('meeting-notes.index');
        Route::get('/create', [MeetingNoteController::class, 'create'])
            ->middleware('role:KI,kabid')
            ->name('meeting-notes.create');
        Route::post('/', [MeetingNoteController::class, 'store'])
            ->middleware('role:KI,kabid')
            ->name('meeting-notes.store');
        Route::get('/{note}', [MeetingNoteController::class, 'show'])->name('meeting-notes.show');
        Route::get('/{note}/edit', [MeetingNoteController::class, 'edit'])
            ->name('meeting-notes.edit');
        Route::put('/{note}', [MeetingNoteController::class, 'update'])
            ->name('meeting-notes.update');
        Route::patch('/{note}/archive', [MeetingNoteController::class, 'toggleArchive'])
            ->middleware('role:KI,kabid')
            ->name('meeting-notes.archive');
        Route::delete('/{note}', [MeetingNoteController::class, 'destroy'])
            ->name('meeting-notes.destroy');
    });
    
    // Files (now points to Teams)
    Route::get('/files', [TeamController::class, 'index'])->name('files.index');
    
    // Teams
    Route::prefix('teams')->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('teams.index');
        Route::get('/{team}/files', [TeamController::class, 'files'])->name('teams.files');
    });
    
    // File Management
    Route::prefix('file-management')->group(function () {
        Route::get('/create', [FileController::class, 'create'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5')
            ->name('files.create');
        Route::post('/', [FileController::class, 'store'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5')
            ->name('files.store');
        Route::get('/{file}', [FileController::class, 'show'])->name('files.show');
        Route::get('/{file}/edit', [FileController::class, 'edit'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5')
            ->name('files.edit');
        Route::put('/{file}', [FileController::class, 'update'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5')
            ->name('files.update');
        Route::get('/{file}/download', [FileController::class, 'download'])->name('files.download');
        Route::delete('/{file}', [FileController::class, 'destroy'])
            ->middleware('role:KI,tim_1,tim_2,tim_3,tim_4,tim_5')
            ->name('files.destroy');
    });

    // User Approval (Kepala Bidang only)
    Route::middleware('role:kabid')->group(function () {
        Route::get('/user-approval', [UserApprovalController::class, 'index'])->name('user-approval.index');
        Route::post('/user-approval/update', [UserApprovalController::class, 'update'])->name('user-approval.update');
        Route::post('/user-approval/revoke', [UserApprovalController::class, 'revoke'])->name('user-approval.revoke');
    });
});
