<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;

// Halaman awal diarahkan ke form login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');

// Proses login & logout
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔹 Semua user setelah login (guru & user)
Route::middleware('auth')->group(function () {
    Route::get('/voting', [VoteController::class, 'index'])->name('voting.index');
    Route::post('/voting', [VoteController::class, 'vote'])->name('voting.vote');
    Route::get('/thanks', [VoteController::class, 'thanks'])->name('thanks');
});

// 🔹 Hanya admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
    Route::get('/admin/vote-stats', [AdminController::class, 'voteStats'])->name('admin.voteStats');
    Route::post('/admin/reset-votes', [AdminController::class, 'resetVotes'])->name('admin.resetVotes');
    Route::post('/admin/reset-user', [AdminController::class, 'resetUserVote'])->name('admin.resetUserVote');
    Route::get('/admin/search-user', [AdminController::class, 'searchUser'])->name('admin.searchUser');

    // CRUD kandidat
    Route::resource('candidates', CandidateController::class);
});
