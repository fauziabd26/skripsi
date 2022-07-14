<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User; 
use App\Models\barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\aproval;
use App\Models\kondisi;
use App\Models\peminjaman;
use App\Models\pengembalian;
use App\Models\paket;
use App\Models\peminjaman_paket;
use App\Models\barang_paket;
use App\Models\barang_peminjaman;

class pengguna extends Model
{
    public function aproval()
    {
		$dosen = Dosen::join('users', 'users.dosen_id', '=', 'dosens.id')
		->get(['dosens.*', 'users.id as id_dosen']);
		$mahasiswa = Mahasiswa::join('users', 'users.mahasiswa_id', '=', 'mahasiswas.id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
        $barang1 = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
        $aproval = aproval::join('users', 'users.id', '=', 'aprovals.nama_peminjam')
        ->get(['aprovals.*', 'users.id as id_Mahasiswa']);
        $barang_peminjaman = barang_peminjaman::allData();
		foreach ($aproval as $key => $aproval1) {
			foreach ($barang_peminjaman as $key => $barang_peminjaman1) {
				foreach ($barang1 as $key => $value) {
					if ($aproval1->kode_barang_peminjaman == $barang_peminjaman1->kode && $barang_peminjaman1->id_barang == $value->id){
						$barang = [
							'Nama Barang' => $value->name,
							'Jumlah Barang' => $barang_peminjaman1->jumlah,
						];
					}
				}
			}
			foreach ($dosen as $key => $value) {
				if ($value->id_dosen == $aproval1->id_dosen){
					$Dosen = [
							'ID Dosen' => $aproval1->id_dosen,
							'Nama Dosen' => $value->name,
						];
				}
				
			}
			foreach ($mahasiswa as $key => $value) {
				if ($value->Mahasiswa_id == $aproval1->id_Mahasiswa){
					$mhs = [
						'Nama Mahasiswa' => $value->name,
						'Nim Mahasiswa' => $value->nim,
						'Kelas Mahasiswa' => $value->kelas,
					];
				}
			}
			$Tanggal = [
						'Tanggal Peminjaman' => $aproval1->tanggal_peminjaman,
						'waktu Peminjaman' => $aproval1->waktu_peminjaman,
					];
		}
		return (compact('barang','Dosen','mhs','Tanggal'));
    }
	
    public function pengembalian()
    {
		$mahasiswa = Mahasiswa::join('users', 'users.mahasiswa_id', '=', 'mahasiswas.id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
		$dosen = Dosen::join('users', 'users.dosen_id', '=', 'dosens.id')
		->get(['dosens.*', 'users.id as id_dosen']);
        $peminjaman = barang_peminjaman::allData();
		$data = peminjaman::join('users', 'users.id', '=', 'peminjamans.nama_peminjam')
        ->get(['peminjamans.*', 'users.id as id_Mahasiswa']);
        $barang1 = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
		foreach ($data as $key1 => $data1) {
			if ($data1->status == "Dipinjam"){
			foreach ($peminjaman as $key2 => $barang_peminjaman1) {
				foreach ($barang1 as $key => $value) {
					if ($data1->kode_barang_peminjaman == $barang_peminjaman1->kode && $barang_peminjaman1->id_barang == $value->id){
						$barang = [
							'Nama Barang' => $value->name,
							'Jumlah Barang' => $barang_peminjaman1->jumlah,
						];
					}
				}
			}
			foreach ($mahasiswa as $key => $value) {
				if ($value->Mahasiswa_id == $data1->id_Mahasiswa){
					$mhs = [
						'Nama Mahasiswa' => $value->name,
						'Nim Mahasiswa' => $value->nim,
						'Kelas Mahasiswa' => $value->kelas,
					];
				}
			}
			$Tanggal = [
						'Tanggal Peminjaman' => $data1->tanggal_peminjaman,
						'waktu Peminjaman' => $data1->waktu_peminjaman,
					];
			}
		}
		return (compact('barang','mhs','Tanggal'));
		
	}
}
