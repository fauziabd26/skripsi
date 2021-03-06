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
		'kode_barang_pengembalian',
		'tanggal_pengembalian',
		'peminjaman_id',
		'kondisi_id',
	];
	
	public function allData()
    {
        return DB::table('pengembalians')->get();
    }
}
