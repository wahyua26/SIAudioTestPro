<?php

use App\Http\Controllers\AudiometriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () { return view('home'); })->name('home');
    Route::get('/menu', [MasterDataController::class,'menu'])->name('menu');
    Route::get('/pegawai', [MasterDataController::class,'pegawai'])->name('pegawai');
    Route::get('/ruang-kerja', [MasterDataController::class,'ruang'])->name('ruang');
    Route::get('/jabatan', [MasterDataController::class,'jabatan'])->name('jabatan');
    Route::get('/audiometri', [AudiometriController::class,'index'])->name('audiometri');
    Route::get('/tambah-pegawai', [UserController::class,'tambahPegawai'])->name('tambah-pegawai');
    Route::get('/edit-pegawai/{id}', [UserController::class,'editPegawai'])->name('edit-pegawai');
    Route::post('/update-pegawai', [UserController::class,'updatePegawai'])->name('update-pegawai');
    Route::get('/hapus-pegawai/{id}', [UserController::class,'hapusPegawai'])->name('hapus-pegawai');
    Route::post('/pegawai', [UserController::class,'store'])->name('store-pegawai');
});

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');

