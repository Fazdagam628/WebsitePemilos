<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CandidateController;

Route::get('/', [AuthController::class,'home'])->name('home');

// Halaman awal diarahkan ke form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login & logout
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/results', [VoteController::class, 'results'])->name('admin.results');
Route::get('/results/data', [VoteController::class, 'stats'])->name('admin.getData');
// 🔹 Semua user setelah login (guru & user)
Route::middleware('auth')->group(function () {
    Route::get('/voting', [VoteController::class, 'index'])->name('vote.index');
    Route::post('/voting', [VoteController::class, 'store'])->name('vote.store');
});

// 🔹 Hanya admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/users/students', [UserController::class, 'students'])->name('users.students');
    Route::get('/admin/users/teachers', [UserController::class, 'teachers'])->name('users.teachers');
    Route::get('/admin/users/create', [AdminController::class, 'store'])->name('users.create');
    Route::post('/admin/users/import', [UserController::class, 'import'])->name('users.import');
    Route::get('/admin/users/import', [UserController::class, 'userImport'])->name('users.importForm');
    Route::post('/admin/reset-votes', [AdminController::class, 'resetVotes'])->name('admin.resetVotes');
    Route::post('/admin/reset-user', [AdminController::class, 'resetUserVote'])->name('admin.resetUserVote');
    Route::get('/admin/search-teacher', [AdminController::class, 'searchUser'])
        ->name('admin.searchTeacher')
        ->defaults('role', 'guru');

    Route::get('/admin/search-student', [AdminController::class, 'searchUser'])
        ->name('admin.searchStudent')
        ->defaults('role', 'user');


    // CRUD kandidat
    Route::resource('candidates', CandidateController::class);
    // Route::get('candidates', CandidateController::class);
    Route::delete('/admin/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
