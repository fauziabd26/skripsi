<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class aproval extends Model
{
    protected $table = "aprovals";
	public $incrementing = false;
	protected $primaryKey = "id";
	protected $fillable = [
		'kode_barang_peminjaman',
		'nama_peminjam',
		'tanggal_peminjaman',
		'waktu_peminjaman',
		'Keterangan',
	];
	
	public function allData()
    {
        return DB::table('aprovals')->get();
    }
}
