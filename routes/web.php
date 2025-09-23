<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserExcelController;


//import users dari excel
Route::get('/users/import', function () {return view('users');});
Route::post('/users/import', [UserExcelController::class, 'import'])->name('users.import');
Route::get('/', function () {return view('welcome');});

//login, logout, dashboard
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman admin
Route::get('/admin', [AuthController::class, 'adminDashboard']);