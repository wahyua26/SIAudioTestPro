<?php

use App\Http\Controllers\AudiometriController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\RekomendasiController;
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

Route::group(['middleware' => ['auth','CekStatus:admin,pegawai']], function () {
    Route::get('/homePegawai/{id}', [AudiometriController::class,'homePegawai'])->name('home');
    Route::get('/detail-akun/{id}', [UserController::class,'detail'])->name('detail-akun');
    Route::get('/edit-akun/{id}', [UserController::class,'editAkun'])->name('edit-akun');
    Route::post('/update-akun', [UserController::class,'updateAkun'])->name('update-akun');
    Route::post('/update-foto-profile', [UserController::class,'updateFoto'])->name('update-foto-profile');
    Route::get('/audiometri-pegawai/{id}', [AudiometriController::class,'indexPegawai'])->name('audiometri-pegawai');
    Route::get('/detail-audiometri/{id}', [AudiometriController::class,'detail'])->name('detail-audiometri');
    Route::get('/cetak-detail-audiometri/{id}', [AudiometriController::class,'cetakDetail'])->name('cetak-detail-audiometri');
});

Route::group(['middleware' => ['auth','CekStatus:admin']], function () {
    Route::get('/home', [AudiometriController::class,'home'])->name('home');
    Route::get('/menu', [MasterDataController::class,'menu'])->name('menu');
    Route::get('/pegawai', [MasterDataController::class,'pegawai'])->name('pegawai');
    Route::get('/ruang-kerja', [MasterDataController::class,'ruang'])->name('ruang');
    Route::get('/jabatan', [MasterDataController::class,'jabatan'])->name('jabatan');
    Route::get('/audiometri', [AudiometriController::class,'index'])->name('audiometri');
    Route::get('/tambah-pegawai', [UserController::class,'tambahPegawai'])->name('tambah-pegawai');
    Route::get('/tambah-jabatan', [MasterDataController::class,'tambahJabatan'])->name('tambah-jabatan');
    Route::get('/tambah-ruang', [MasterDataController::class,'tambahRuang'])->name('tambah-ruang');
    Route::get('/edit-pegawai/{id}', [UserController::class,'editPegawai'])->name('edit-pegawai');
    Route::post('/update-pegawai', [UserController::class,'updatePegawai'])->name('update-pegawai');
    Route::get('/hapus-pegawai/{id}', [UserController::class,'hapusPegawai'])->name('hapus-pegawai');
    Route::post('/pegawai', [UserController::class,'store'])->name('store-pegawai');
    Route::post('/jabatan', [MasterDataController::class,'kirimJabatan'])->name('kirim-jabatan');
    Route::get('/edit-jabatan/{id}', [MasterDataController::class,'editJabatan'])->name('edit-jabatan');
    Route::post('/update-jabatan', [MasterDataController::class,'updateJabatan'])->name('update-jabatan');
    Route::get('/hapus-jabatan/{id}', [MasterDataController::class,'hapusJabatan'])->name('hapus-jabatan');
    Route::post('/ruang-kerja', [MasterDataController::class,'kirimRuang'])->name('kirim-ruang');
    Route::get('/edit-ruang/{id}', [MasterDataController::class,'editRuang'])->name('edit-ruang');
    Route::post('/update-ruang', [MasterDataController::class,'updateRuang'])->name('update-ruang');
    Route::get('/hapus-ruang/{id}', [MasterDataController::class,'hapusRuang'])->name('hapus-ruang');
    Route::get('/rekomendasi', [RekomendasiController::class,'index'])->name('rekomendasi');
    Route::post('/rekomendasi', [RekomendasiController::class,'detail'])->name('detail');
    Route::get('/minta-rekomendasi', [RekomendasiController::class,'mintaRekomendasi'])->name('minta-rekomendasi');
    Route::post('/minta-rekomendasi', [RekomendasiController::class,'model'])->name('model-rekomendasi');
});

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');

Route::get('lang/{locale}', [LocalizationController::class, 'lang']);
Route::get('/model', [RekomendasiController::class, 'model'])->name('model');

Route::get('/api', [MasterDataController::class, 'api'])->name('api');