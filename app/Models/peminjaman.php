<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class peminjaman extends Model
{
    protected $table = "peminjamans";
	protected $primaryKey = "id";
	public $incrementing = false;
	protected $fillable = [
		'kode_barang_peminjaman',
		'nama_peminjam',
		'tanggal_peminjaman',
		'waktu_peminjaman',
		'aprovals',
		'status',
	];
	
	public function allData()
    {
        return DB::table('peminjamans')->get();
    }
}
