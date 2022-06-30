<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class peminjaman extends Model
{
    protected $table = "peminjamans";
	protected $primaryKey = "id";
	protected $fillable = [
		'kode_barang',
		'nama_barang',
		'kategori_barang',
		'satuan_barang',
		'nama_peminjam',
		'jumlah_peminjam',
		'tanggal_peminjaman',
		'waktu_peminjaman',
		'aprovals',
	];
	
	public function allData()
    {
        return DB::table('peminjamans')->get();
    }
}
