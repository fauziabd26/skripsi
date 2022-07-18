<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class peminjaman_paket extends Model
{
    protected $table = "peminjaman_pakets";
	protected $primaryKey = "id";
	public $incrementing = false;
	protected $fillable = [
		'kode_paket',
		'nama_peminjam',
		'jumlah_peminjaman',
		'tanggal_peminjaman',
		'waktu_peminjaman',
		'Keterangan',
	];
	
	public function allData()
    {
        return DB::table('peminjaman_pakets')->get();
    }
}
