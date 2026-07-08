<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('jobs.index');
});

Route::get('/jobs', [JobPostingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{jobPosting}', [JobPostingController::class, 'show'])->name('jobs.show');
Route::post('/jobs/{jobPosting}/applications', [ApplicationController::class, 'store'])->name('applications.store');

Route::get('/dashboard', function () {
    return redirect()->route('admin.jobs.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::patch('jobs/{job}/toggle', [\App\Http\Controllers\Admin\JobController::class, 'togglePublish'])->name('jobs.toggle');
        Route::delete('jobs/{job}/force', [\App\Http\Controllers\Admin\JobController::class, 'forceDelete'])->name('jobs.force-delete');
        Route::resource('jobs', \App\Http\Controllers\Admin\JobController::class);
    });
});

require __DIR__.'/auth.php';
