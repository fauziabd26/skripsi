<?php

use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\BarangMasukController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\SatuanController;
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
Route::get('kategori', [KategoriController::class,'index'])->name('index_api_kategori');
Route::get('kategori/{id}', [KategoriController::class,'show'])->name('show_api_kategori');
Route::post('kategori', [KategoriController::class,'store'])->name('post_api_kategori');
Route::put('kategori/{id}', [KategoriController::class,'update'])->name('put_api_kategori');
Route::delete('kategori/{id}', [KategoriController::class,'destroy'])->name('delete_api_kategori');

//Api Satuan
Route::get('satuan', [SatuanController::class,'index'])->name('index_api_satuan');
Route::get('satuan/{id}', [SatuanController::class,'show'])->name('show_api_satuan');
Route::post('satuan', [SatuanController::class,'store'])->name('post_api_satuan');
Route::put('satuan/{id}', [SatuanController::class,'update'])->name('put_api_satuan');
Route::delete('satuan/{id}', [SatuanController::class,'destroy'])->name('delete_api_satuan');

//Api Mahasiswa
Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('index_api_mahasiswa');
Route::get('mahasiswa/{id}', [MahasiswaController::class,'show'])->name('show_api_mahasiswa');
Route::post('mahasiswa', [MahasiswaController::class, 'store'])->name('post_api_mahasiswa');
Route::put('mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('put_api_mahasiswa');
Route::delete('mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('delete_api_mahasiswa');

//Api Dosen
Route::get('dosen', [DosenController::class, 'index'])->name('index_api_dosen');
Route::get('dosen/{id}', [DosenController::class,'show'])->name('show_api_dosen');
Route::post('dosen', [DosenController::class, 'store'])->name('post_api_dosen');
Route::put('dosen/{id}', [DosenController::class, 'update'])->name('put_api_dosen');
Route::delete('dosen/{id}', [DosenController::class, 'destroy'])->name('delete_api_dosen');

//Api Barang
Route::get('barang', [BarangController::class, 'index'])->name('index_api_barang');
Route::get('barang/{id}', [BarangController::class,'show'])->name('show_api_barang');
Route::post('barang', [BarangController::class, 'store'])->name('post_api_barang');
Route::post('barang/{id}', [BarangController::class, 'update'])->name('put_api_barang');
Route::delete('barang/{id}', [BarangController::class, 'destroy'])->name('delete_api_barang');

//Api Barang Masuk
Route::get('barang_masuk', [BarangMasukController::class, 'index'])->name('index_api_barangmasuk');
Route::get('barang_masuk/{id}', [BarangMasukController::class,'show'])->name('show_api_barangmasuk');
Route::post('barang_masuk', [BarangMasukController::class, 'store'])->name('post_api_barangmasuk');
Route::post('barang_masuk/{id}', [BarangMasukController::class, 'update'])->name('put_api_barangmasuk');
Route::delete('barang_masuk/{id}', [BarangMasukController::class, 'destroy'])->name('delete_api_barangmasuk');
