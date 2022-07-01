<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class pengembalian extends Model
{
    protected $table = "pengembalians";
	protected $primaryKey = "id";
	public $incrementing = false;
	protected $fillable = [
		'nama_barang',
		'nama_peminjam',
		'jumlah_pengembalian',
		'tanggal_peminjaman',
		'waktu_peminjaman',
		'tanggal_pengembalian',
		'kondisi',
	];
	
	public function allData()
    {
        return DB::table('pengembalians')->get();
    }
}
