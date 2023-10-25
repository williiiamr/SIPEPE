<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;
use Psy\Command\HistoryCommand;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest:karyawan'])->group(function (){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'prosesLogin']);
});

Route::middleware(['guest:user'])->group(function (){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});


Route::middleware(['auth:karyawan'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/proseslogout', [AuthController::class, 'prosesLogout']);

    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);

    Route::get('/history', [HistoryController::class, 'history']);

    Route::post('/gethistori', [HistoryController::class, 'gethistori']);
    
});

Route::middleware(['auth:user'])->group(function (){
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'admindashboard']);

    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/{nik}/update', [KaryawanController::class, 'update']);
    Route::post('/karyawan/{nik}/delete', [KaryawanController::class, 'delete']);

    Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::get('/presensi/laporan', [PresensiController::class, 'laporan']);
    Route::post('/presensi/cetak', [PresensiController::class, 'cetak']);

    Route::get('/settings', [KaryawanController::class, 'setting']);
    Route::post('/settings/update', [KaryawanController::class, 'updateSetting']);
});
