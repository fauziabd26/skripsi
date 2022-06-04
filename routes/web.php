<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('dashboard.view');
// });

use App\Http\Controllers\LoginController;
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/post', [LoginController::class, 'login'])->name('post_login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\UserController;
Route::get('/user/profile/{user}', [UserController::class, 'userProfile'])->name('user.profile');
Route::get('/user/profile/edit/{user}', [UserController::class, 'editUserProfile'])->name('user.profile.edit');
Route::put('/user/profile/update/{user}', [UserController::class, 'updateUserProfile'])->name('user.profile.update');
Route::get('profile', 'UserController@edit')->name('profile.edit');
Route::patch('profile', 'UserController@update')->name('profile.update');

//Route Ubah Password
Route::get('password', 'UserController@editPassword')->name('user.password.edit');
Route::patch('password', 'UserController@updatePassword')->name('user.password.update');

//Route Dashboard
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('barang', [HomeController::class, 'index_barang'])->name('index_barang')->middleware('admin');
Route::get('kategori', 'HomeController@index_kategori')->name('index_kategori');

//Route Mahasiswa
use App\Http\Controllers\MahasiswaController;
Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('index_mahasiswa')->middleware('admin');
Route::get('mahasiswa/add', [MahasiswaController::class, 'create'])->name('tambah_mahasiswa')->middleware('admin');
Route::post('/mahasiswa/post', [MahasiswaController::class, 'store'])->name('post_mahasiswa')->middleware('admin');
Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('edit_mahasiswa')->middleware('admin');
Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('update_mahasiswa')->middleware('admin');
Route::get('/mahasiswa/delete{id}', [MahasiswaController::class, 'destroy'])->name('destroy_mahasiswa')->middleware('admin');

//Route Admin
use App\Http\Controllers\RegisterController;
Route::get('admin/add', [RegisterController::class, 'createAdmin'])->name('tambah_admin');
Route::post('/admin/post', [RegisterController::class, 'storeAdmin'])->name('post_admin');
//Route Kalab
Route::get('dashboard_kepala_laboratorium', [UserController::class, 'indexKalab'])->name('index_kalab');
Route::get('kalab/add', [RegisterController::class, 'createKalab'])->name('tambah_kalab')->middleware('admin');
Route::post('/kalab/post', [RegisterController::class, 'storeKalab'])->name('post_kalab')->middleware('admin');
//Route Dosen
use App\Http\Controllers\DosenController;
Route::get('dosen', [DosenController::class, 'index'])->name('index_dosen')->middleware('admin');
Route::get('dosen/add', [DosenController::class, 'create'])->name('tambah_dosen')->middleware('admin');
Route::post('/dosen/post', [DosenController::class, 'store'])->name('post_dosen')->middleware('admin');
Route::get('/dosen/edit/{id}', [DosenController::class, 'edit'])->name('edit_dosen')->middleware('admin');
Route::put('/dosen/update/{id}', [DosenController::class, 'update'])->name('update_dosen')->middleware('admin');
Route::get('/dosen/delete{id}', [DosenController::class, 'destroy'])->name('destroy_dosen')->middleware('admin');

//Route Barang
use App\Http\Controllers\BarangController;
Route::get('/barang/add', [BarangController::class, 'create'])->name('tambah_barang')->middleware('admin');
Route::post('/barang/post', [BarangController::class, 'store'])->name('post_barang')->middleware('admin');
Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('edit_barang')->middleware('admin');
Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('update_barang')->middleware('admin');
Route::get('/barang/delete{id}', [BarangController::class, 'destroy'])->name('destroy_barang')->middleware('admin');
Route::get('/search_barang', [BarangController::class, 'search'])->name('cari_barang');
Route::get('/laporan_barang', [BarangController::class,'indexBarang'])->name('index_laporan_barang');
Route::get('print_barang_pertanggal/{tglawal}/{tglakhir}', [BarangController::class, 'cetakpertanggal'])->name('cetak_barang');
Route::get('/barang/trash', [BarangController::class, 'trash'])->name('index_recycle_bin');
Route::get('/barang/kembalikan/{id}', [BarangController::class, 'kembalikan'])->name('restore_barang');
Route::get('/barang/kembalikan_semua', [BarangController::class, 'kembalikan_semua'])->name('restore_all_barang');
Route::get('/barang/hapus_permanen/{id}', [BarangController::class, 'hapus_permanen'])->name('delete_barang');
Route::get('/guru/hapus_permanen_semua', [BarangController::class, 'hapus_permanen_semua'])->name('delete_all');


//Route Kategori
use App\Http\Controllers\KategoriController;
Route::get('/kategori/add', [KategoriController::class, 'create'])->name('tambah_kategori')->middleware('admin');
Route::post('/kategori/post', [KategoriController::class, 'store'])->name('post_kategori')->middleware('admin');
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('edit_kategori')->middleware('admin');
Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('update_kategori')->middleware('admin');
Route::get('/kategori/delete{id}', [KategoriController::class, 'destroy'])->name('destroy_kategori')->middleware('admin');


//Route Satuan
use App\Http\Controllers\SatuanController;
Route::get('/satuan', [SatuanController::class, 'index'])->name('index_satuan')->middleware('admin');
Route::get('/satuan/add', [SatuanController::class, 'create'])->name('tambah_satuan')->middleware('admin');
Route::post('/satuan/post', [SatuanController::class, 'store'])->name('post_satuan')->middleware('admin');
Route::get('/satuan/edit/{id}', [SatuanController::class, 'edit'])->name('edit_satuan')->middleware('admin');
Route::put('/satuan/update/{id}', [SatuanController::class, 'update'])->name('update_satuan')->middleware('admin');
Route::get('/satuan/delete{id}', [SatuanController::class, 'destroy'])->name('destroy_satuan')->middleware('admin');

//Route Barang Masuk
use App\Http\Controllers\BarangMasukController;
Route::get('/barang_masuk', [BarangMasukController::class, 'index'])->name('index_barang_masuk')->middleware('admin');
Route::get('/barang_masuk/add', [BarangMasukController::class, 'create'])->name('tambah_barang_masuk')->middleware('admin');
Route::post('/barang_masuk/post', [BarangMasukController::class, 'store'])->name('post_barang_masuk')->middleware('admin');
Route::get('/barang_masuk/edit/{id}', [BarangMasukController::class, 'edit'])->name('edit_barang_masuk')->middleware('admin');
Route::put('/barang_masuk/update/{id}', [BarangMasukController::class, 'update'])->name('update_barang_masuk')->middleware('admin');
Route::get('/barang_masuk/delete{id}', [BarangMasukController::class, 'destroy'])->name('destroy_barang_masuk')->middleware('admin');

//Route Peminjaman
use App\Http\Controllers\PeminjamanController;
Route::get('Peminjaman', [PeminjamanController::class, 'index'])->name('index_Peminjaman');
Route::get('Peminjaman/add', [PeminjamanController::class, 'create'])->name('tambah_Peminjaman');
Route::post('Peminjaman/post', [PeminjamanController::class, 'store'])->name('post_Peminjaman');
Route::get('Peminjaman/edit/{id}', [PeminjamanController::class, 'edit']);
Route::put('Peminjaman/update/{id}', [PeminjamanController::class, 'update']);
Route::get('Peminjaman/delete/{id}', [PeminjamanController::class, 'destroy']);

//Route Pengembalian
use App\Http\Controllers\PengembalianController;
Route::get('Pengembalian', [PengembalianController::class, 'index'])->name('index_Pengembalian');
Route::get('Pengembalian/add', [PengembalianController::class, 'create'])->name('tambah_Pengembalian');
Route::post('Pengembalian/post', [PengembalianController::class, 'store'])->name('post_Pengembalian');
Route::get('Pengembalian/edit/{id}', [PengembalianController::class, 'edit']);
Route::put('Pengembalian/update/{id}', [PengembalianController::class, 'update']);
Route::get('Pengembalian/delete/{id}', [PengembalianController::class, 'destroy']);

//Route Pengguna Mahasiswa
use App\Http\Controllers\PenggunaController;
Route::get('PenggunaMahasiswa', [PenggunaController::class, 'index'])->name('index_Peminjaman_pengguna');
Route::post('PenggunaMahasiswa/add/{id}', [PenggunaController::class, 'store']);
Route::get('PenggunaMahasiswa/edit/{id}', [PenggunaController::class, 'edit']);
Route::put('PenggunaMahasiswa/update/{id}', [PenggunaController::class, 'update']);

Route::get('PenggunaMahasiswaPengembalian', [PenggunaController::class, 'indexPengembalian']);
Route::post('PenggunaMahasiswaPengembalian/add', [PenggunaController::class, 'storepengembalian']);

//Route Pengguna Dosen
Route::get('PenggunaDosen', [PenggunaController::class, 'indexdosen']);
Route::post('PenggunaDosen/add', [PenggunaController::class, 'storedosen']);
Route::get('PenggunaDosen/delete/{id}', [PenggunaController::class, 'destroyAproval']);

//Route Aproval
Route::get('Aproval', [PenggunaController::class, 'indexaproval']);
Route::post('Aproval/add/{id}', [PenggunaController::class, 'storeaproval']);

//Route paket barang
use App\Http\Controllers\PaketController;
Route::get('paket', [PaketController::class, 'index'])->name('index_Paket');
Route::get('paket/add', [PaketController::class, 'create'])->name('create_Paket');
Route::post('paket/add/post', [PaketController::class, 'store'])->name('post_create_Paket');

//Route import export
Route::post('import', function () {
    Excel::import(new UsersImport, request()->file('file'));
    return redirect()->back()->with('success','Data Imported Successfully');
});
use App\Http\Controllers\LaporanController;
Route::get('/laporan_barang/export_excel', [LaporanController::class,'export_excel'])->name('export_laporan_barang');