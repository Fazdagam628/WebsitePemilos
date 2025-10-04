<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CandidateController;

// Halaman awal diarahkan ke form login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login & logout
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔹 Semua user setelah login (guru & user)
Route::middleware('auth')->group(function () {
    Route::get('/voting', [VoteController::class, 'index'])->name('vote.index');
    Route::post('/voting', [VoteController::class, 'store'])->name('vote.store');
});

// 🔹 Hanya admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/results', [VoteController::class, 'results'])->name('admin.results');
    Route::get('/admin/results/data', [VoteController::class, 'stats'])->name( 'admin.getData');

    Route::post('/admin/users', [AdminController::class, 'store'])->name('users.store');
    Route::post('/admin/import', [AdminController::class, 'import'])->name('users.import');
    Route::post('/admin/reset-votes', [AdminController::class, 'resetVotes'])->name('admin.resetVotes');
    Route::post('/admin/reset-user', [AdminController::class, 'resetUserVote'])->name('admin.resetUserVote');
    Route::get('/admin/search-user', [AdminController::class, 'searchUser'])->name('admin.searchUser');

    // CRUD kandidat
    Route::resource('candidates', CandidateController::class);
});
