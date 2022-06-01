<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class aproval extends Model
{
    protected $table = "aprovals";
	protected $primaryKey = "id";
	protected $fillable = [
		'kode_barang',
		'nama_barang',
		'kategori_barang',
		'satuan_barang',
		'nama_peminjam',
		'jumlah_peminjaman',
		'tanggal_peminjaman',
		'waktu_peminjaman',
	];
	
	public function allData()
    {
        return DB::table('aprovals')->get();
    }
}
