<?php

use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\BarangMasukController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\loginController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\SatuanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PenggunaAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Api Kategori
Route::get('kategori', [KategoriController::class,'index']);
Route::get('kategori/{id}', [KategoriController::class,'show']);
Route::post('kategori', [KategoriController::class,'store']);
Route::put('kategori/{id}', [KategoriController::class,'update']);
Route::delete('kategori/{id}', [KategoriController::class,'destroy']);

//Api Satuan
Route::get('satuan', [SatuanController::class,'index']);
Route::get('satuan/{id}', [SatuanController::class,'show']);
Route::post('satuan', [SatuanController::class,'store']);
Route::put('satuan/{id}', [SatuanController::class,'update']);
Route::delete('satuan/{id}', [SatuanController::class,'destroy']);

//Api Mahasiswa
Route::get('mahasiswa', [MahasiswaController::class, 'index']);
Route::get('mahasiswa/{id}', [MahasiswaController::class,'show']);
Route::post('mahasiswa', [MahasiswaController::class, 'store']);
Route::put('mahasiswa/{id}', [MahasiswaController::class, 'update']);
Route::delete('mahasiswa/{id}', [MahasiswaController::class, 'destroy']);

//Api Dosen
Route::get('dosen', [DosenController::class, 'index']);
Route::get('dosen/{id}', [DosenController::class,'show']);
Route::post('dosen', [DosenController::class, 'store']);
Route::put('dosen/{id}', [DosenController::class, 'update']);
Route::delete('dosen/{id}', [DosenController::class, 'destroy']);

//Api Barang
Route::get('barang', [BarangController::class, 'index']);
Route::get('barang/{id}', [BarangController::class,'show']);
Route::post('barang', [BarangController::class, 'store']);
Route::post('barang/{id}', [BarangController::class, 'update']);
Route::delete('barang/{id}', [BarangController::class, 'destroy']);

//Api Barang Masuk
Route::get('barang_masuk', [BarangMasukController::class, 'index']);
Route::get('barang_masuk/{id}', [BarangMasukController::class,'show']);
Route::post('barang_masuk', [BarangMasukController::class, 'store']);
Route::post('barang_masuk/{id}', [BarangMasukController::class, 'update']);
Route::delete('barang_masuk/{id}', [BarangMasukController::class, 'destroy']);

//Api User
Route::get('user', [UserController::class, 'index']);
Route::post('registerAdmin', [loginController::class, 'registerAdmin']);
Route::post('login', [loginController::class, 'login']);
Route::post('logout', [loginController::class, 'logout']);

//Api Peminjaman
Route::get('Peminjaman', [PenggunaAPIController::class, 'indexAPI']);
Route::post('Peminjaman/Add', [PenggunaAPIController::class, 'storeAPI']);
Route::get('PeminjamanDosen', [PenggunaAPIController::class, 'indexdosenAPI']);
Route::post('PeminjamanDosen/Add/{id}', [PenggunaAPIController::class, 'storedosenAPI']);
Route::get('Pengembalian', [PenggunaAPIController::class, 'indexPengembalianAPI']);
Route::post('Pengembalian/Add', [PenggunaAPIController::class, 'storepengembalianAPI']);
Route::get('PeminjamanPaket', [PenggunaAPIController::class, 'indexpaketAPI']);
Route::post('PeminjamanPaket/add/{id}', [PenggunaAPIController::class, 'storepaketAPI']);
Route::post('PeminjamanDosen/Delete/{id}', [PenggunaAPIController::class, 'destroyAprovalAPI']);