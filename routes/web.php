<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingScheduleController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MeetingNoteController;
use Illuminate\Support\Facades\Route;

// Redirect root to dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
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
    
    // Files
    Route::prefix('files')->group(function () {
        Route::get('/', [FileController::class, 'index'])->name('files.index');
        Route::get('/create', [FileController::class, 'create'])->name('files.create');
        Route::post('/', [FileController::class, 'store'])->name('files.store');
        Route::get('/{file}', [FileController::class, 'show'])->name('files.show');
        Route::get('/{file}/edit', [FileController::class, 'edit'])->name('files.edit');
        Route::put('/{file}', [FileController::class, 'update'])->name('files.update');
        Route::get('/{file}/download', [FileController::class, 'download'])->name('files.download');
        Route::delete('/{file}', [FileController::class, 'destroy'])
            ->name('files.destroy');
    });
});
