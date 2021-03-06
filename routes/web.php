<?php

use Illuminate\Support\Facades\Route;

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
Route::get('forgot-password', 'UserController@forgotPassword')->name('user.password.forgot');
Route::post('/forgot-password', 'UserController@postEmail')->name('store.forgot.password');
Route::get('/reset-password/{token}', 'UserController@getPassword');
Route::post('/reset-password', 'UserController@updateResetPassword')->name('reset.password.update');

//Route Dashboard
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('stok', [HomeController::class, 'grafik']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('barang', [HomeController::class, 'index_barang'])->name('index_barang');
Route::get('kategori', [HomeController::class, 'index_kategori'])->name('index_kategori');

//Route Mahasiswa
use App\Http\Controllers\MahasiswaController;
Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('index_mahasiswa');
Route::get('mahasiswa/add', [MahasiswaController::class, 'create'])->name('tambah_mahasiswa')->middleware('admin');
Route::post('/mahasiswa/post', [MahasiswaController::class, 'store'])->name('post_mahasiswa')->middleware('admin');
Route::get('/mahasiswa/delete{id}', [MahasiswaController::class, 'destroy'])->name('destroy_mahasiswa')->middleware('admin');
Route::get('search_mahasiswa', [MahasiswaController::class, 'search'])->name('cari_mahasiswa');

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
Route::get('dosen', [DosenController::class, 'index'])->name('index_dosen');
Route::get('dosen/add', [DosenController::class, 'create'])->name('tambah_dosen')->middleware('admin');
Route::post('/dosen/post', [DosenController::class, 'store'])->name('post_dosen')->middleware('admin');
Route::get('/dosen/delete{id}', [DosenController::class, 'destroy'])->name('destroy_dosen')->middleware('admin');
Route::get('search_dosen', [DosenController::class, 'search'])->name('cari_dosen');

//Route Barang
use App\Http\Controllers\BarangController;
Route::get('/barang/add', [BarangController::class, 'create'])->name('tambah_barang')->middleware('admin');
Route::post('/barang/post', [BarangController::class, 'store'])->name('post_barang')->middleware('admin');
Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('edit_barang')->middleware('admin');
Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('update_barang')->middleware('admin');
Route::get('/barang/delete{id}', [BarangController::class, 'destroy'])->name('destroy_barang')->middleware('admin');
Route::get('/search_barang', [BarangController::class, 'search'])->name('cari_barang');
Route::get('/laporan_barang', [BarangController::class,'indexBarang'])->name('index_laporan_barang');
Route::get('/barang/trash', [BarangController::class, 'trash'])->name('index_recycle_bin');
Route::get('/barang/kembalikan/{id}', [BarangController::class, 'kembalikan'])->name('restore_barang');
Route::get('/barang/kembalikan_semua', [BarangController::class, 'kembalikan_semua'])->name('restore_all_barang');
Route::get('/barang/hapus_permanen/{id}', [BarangController::class, 'hapus_permanen'])->name('delete_barang');
Route::get('/guru/hapus_permanen_semua', [BarangController::class, 'hapus_permanen_semua'])->name('delete_all');
Route::post('/laporan_masuk', 'BarangController@cetakpertanggal');
Route::get('/laporan_excel', 'BarangController@export');
Route::post('/import_barang', [BarangController::class, 'import'])->name('import_barang')->middleware('admin');
Route::get('getfile', [BarangController::class, 'getFile'])->name('getfile');
Route::get('getfile_public', [BarangController::class, 'getFile_public'])->name('getfilePublic');

//Route Kategori
use App\Http\Controllers\KategoriController;
Route::get('/kategori/add', [KategoriController::class, 'create'])->name('tambah_kategori')->middleware('admin');
Route::post('/kategori/post', [KategoriController::class, 'store'])->name('post_kategori')->middleware('admin');
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('edit_kategori')->middleware('admin');
Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('update_kategori')->middleware('admin');
Route::get('/kategori/delete{id}', [KategoriController::class, 'destroy'])->name('delete_kategori')->middleware('admin');

//Route Satuan
use App\Http\Controllers\SatuanController;
Route::get('/satuan', [SatuanController::class, 'index'])->name('index_satuan');
Route::get('/satuan/add', [SatuanController::class, 'create'])->name('tambah_satuan')->middleware('admin');
Route::post('/satuan/post', [SatuanController::class, 'store'])->name('post_satuan')->middleware('admin');
Route::get('/satuan/edit/{id}', [SatuanController::class, 'edit'])->name('edit_satuan')->middleware('admin');
Route::put('/satuan/update/{id}', [SatuanController::class, 'update'])->name('update_satuan')->middleware('admin');
Route::get('/satuan/delete{id}', [SatuanController::class, 'destroy'])->name('destroy_satuan')->middleware('admin');

//Route Suppliers
use App\Http\Controllers\SuppliersController;
Route::get('/suppliers', [SuppliersController::class, 'index'])->name('index_suppliers');
Route::get('/suppliers/add', [SuppliersController::class, 'create'])->name('tambah_suppliers')->middleware('admin');
Route::post('/suppliers/post', [SuppliersController::class, 'store'])->name('post_suppliers')->middleware('admin');
Route::get('/suppliers/edit/{id}', [SuppliersController::class, 'edit'])->name('edit_suppliers')->middleware('admin');
Route::put('/suppliers/update/{id}', [SuppliersController::class, 'update'])->name('update_suppliers')->middleware('admin');
Route::get('/suppliers/delete{id}', [SuppliersController::class, 'destroy'])->name('destroy_suppliers')->middleware('admin');
Route::get('/search_suppliers', [SuppliersController::class, 'search'])->name('cari_suppliers');

//Route Barang Masuk
use App\Http\Controllers\BarangMasukController;
Route::get('/barang_masuk', [BarangMasukController::class, 'index'])->name('index_barang_masuk');
Route::get('/barang_masuk/add', [BarangMasukController::class, 'create'])->name('tambah_barang_masuk')->middleware('admin');
Route::post('/barangmasuk/post', [BarangMasukController::class, 'store'])->name('post_barangmasuk')->middleware('admin');
Route::get('/barang_masuk/edit/{id}', [BarangMasukController::class, 'edit'])->name('edit_barang_masuk')->middleware('admin');
Route::put('/barang_masuk/update{id}', [BarangMasukController::class, 'update'])->name('update_barang_masuk')->middleware('admin');
Route::get('/barang_masuk/delete{id}', [BarangMasukController::class, 'destroy'])->name('destroy_barang_masuk')->middleware('admin');

//Route Peminjaman
use App\Http\Controllers\PeminjamanController;
Route::get('Peminjaman', [PeminjamanController::class, 'index'])->name('index_Peminjaman')->middleware('admin');
Route::get('Peminjaman/add', [PeminjamanController::class, 'create'])->name('tambah_Peminjaman')->middleware('admin');
Route::post('Peminjaman/post', [PeminjamanController::class, 'store'])->name('post_Peminjaman')->middleware('admin');
Route::get('Peminjaman/edit/{id}', [PeminjamanController::class, 'edit'])->middleware('admin');
Route::put('Peminjaman/update/{id}', [PeminjamanController::class, 'update'])->middleware('admin');
Route::get('Peminjaman/Serahkan/{id}', [PeminjamanController::class, 'Serahkan'])->middleware('admin');
Route::get('Peminjaman/delete/{id}', [PeminjamanController::class, 'destroy'])->middleware('admin');
Route::get('Peminjaman/edit/deletebarang/{id}', [PeminjamanController::class, 'destroypeminjamanbarang'])->name('kembali')->middleware('admin');
Route::get('PeminjamanPaket', [PeminjamanController::class, 'indexpaket'])->name('Peminjaman_paket')->middleware('admin');
Route::get('PeminjamanPaket/edit/{id}', [PeminjamanController::class, 'editPaket'])->name('Peminjaman_paket_edit')->middleware('admin');
Route::put('PeminjamanPaket/edit/post/{id}', [PeminjamanController::class, 'editPaketpos'])->name('Peminjaman_paket_edit_post')->middleware('admin');
Route::get('PeminjamanPaket/delete/{id}', [PeminjamanController::class, 'destroypeminjamanpaket'])->middleware('admin');
Route::post('/laporan_pdf_peminjaman', 'PeminjamanController@cetakpertanggal')->middleware('admin');
Route::get('/laporan_excel_peminjaman', 'PeminjamanController@export')->middleware('admin');
Route::get('/laporan_Peminjaman', [PeminjamanController::class,'indexlaporan'])->name('index_laporan_peminjaman')->middleware('admin');
Route::get('/laporan_Peminjaman_Paket', [PeminjamanController::class,'indexlaporanPaket'])->name('index_laporan_peminjaman_paket')->middleware('admin');
Route::post('/laporan_pdf_paket', 'PeminjamanController@cetakpertanggalpaket')->middleware('admin');
Route::get('/laporan_excel_paket', 'PeminjamanController@exportpaket')->middleware('admin');

//Route Pengembalian
use App\Http\Controllers\PengembalianController;
Route::get('Pengembalian', [PengembalianController::class, 'index'])->name('index_Pengembalian')->middleware('admin');
Route::get('Pengembalian/add', [PengembalianController::class, 'create'])->name('tambah_Pengembalian')->middleware('admin');
Route::post('Pengembalian/post', [PengembalianController::class, 'store'])->name('post_Pengembalian')->middleware('admin');
Route::get('Pengembalian/edit/{id}', [PengembalianController::class, 'edit'])->middleware('admin');
Route::put('Pengembalian/update/{id}', [PengembalianController::class, 'update'])->middleware('admin');
Route::get('Pengembalian/Kembalikan/{id}', [PengembalianController::class, 'Kembalikan'])->middleware('admin');
Route::get('Pengembalian/delete/{id}', [PengembalianController::class, 'destroy'])->middleware('admin');
Route::get('/laporan_Pengembalian', [PengembalianController::class,'indexlaporan'])->name('laporan_Pengembalian')->middleware('admin');
Route::post('/laporan_pdf_Pengembalian', 'PengembalianController@cetakpertanggal')->middleware('admin');
Route::get('/laporan_excel_Pengembalian', 'PengembalianController@export')->middleware('admin');

//Route Pengguna Mahasiswa
use App\Http\Controllers\PenggunaController;
Route::get('PenggunaMahasiswa', [PenggunaController::class, 'index'])->name('index_Peminjaman_pengguna')->middleware('mahasiswa');
Route::get('PenggunaMahasiswa/add/', [PenggunaController::class, 'create'])->name('create_Peminjaman')->middleware('mahasiswa');
Route::post('PenggunaMahasiswa/add/', [PenggunaController::class, 'store'])->name('post_create_Peminjaman')->middleware('mahasiswa');
Route::get('PenggunaMahasiswa/edit/{id}', [PenggunaController::class, 'edit'])->middleware('mahasiswa');
Route::put('PenggunaMahasiswa/update/{id}', [PenggunaController::class, 'update'])->middleware('mahasiswa');
Route::get('PenggunaMahasiswapaket', [PenggunaController::class, 'indexpaket'])->name('index_paket_pengguna')->middleware('multi');
Route::post('PenggunaMahasiswapaket/add/{id}', [PenggunaController::class, 'storepaket'])->name('index_Peminjaman_paket')->middleware('multi');

Route::get('PenggunaMahasiswaPengembalian', [PenggunaController::class, 'indexPengembalian'])->middleware('mahasiswa');
Route::post('PenggunaMahasiswaPengembalian/add', [PenggunaController::class, 'storepengembalian'])->middleware('mahasiswa');

//Route Pengguna Dosen
Route::get('PenggunaDosen', [PenggunaController::class, 'indexdosen'])->name('Aproval')->middleware('dosen');
Route::post('PenggunaDosen/add/{id}', [PenggunaController::class, 'storedosen'])->middleware('dosen');
Route::get('PenggunaDosen/delete/{id}', [PenggunaController::class, 'destroyAproval'])->middleware('dosen');


//Route Aproval
Route::get('Aproval', [PenggunaController::class, 'indexaproval'])->name('index_aproval')->middleware('admin');
Route::post('Aproval/add/{id}', [PenggunaController::class, 'storeaproval'])->middleware('admin');
Route::get('Aproval/delete/{id}', [PenggunaController::class, 'destroyAprovalAdmin'])->middleware('admin');

//Route paket barang
use App\Http\Controllers\PaketController;
Route::get('paket', [PaketController::class, 'index'])->name('index_Paket')->middleware('admin');
Route::get('paket/add', [PaketController::class, 'create'])->name('create_Paket')->middleware('admin');
Route::post('paket/add/post', [PaketController::class, 'store'])->name('post_create_Paket')->middleware('admin');
Route::get('paket/edit/{id}', [PaketController::class, 'edit_paket'])->name('edit_Paket')->middleware('admin');
Route::put('paket/edit/post/{id}', [PaketController::class, 'updatePaket'])->name('post_update_Paket')->middleware('admin');
Route::get('paket/delete/{id}', [PaketController::class, 'destroy'])->middleware('admin');
Route::get('paket/edit/deletebarang/{id}', [PaketController::class, 'destroypaketbarang'])->name('kembali_')->middleware('admin');


