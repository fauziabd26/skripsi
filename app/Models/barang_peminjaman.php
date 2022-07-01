<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class barang_peminjaman extends Model
{
    protected $table = "barang_peminjamans";
	protected $primaryKey = "id";
	public $incrementing = false;
	protected $fillable = [
		'id_barang',
		'kode',
		'jumlah',
	];
	
	public function allData()
    {
        return DB::table('barang_peminjamans')->get();
    }
}
