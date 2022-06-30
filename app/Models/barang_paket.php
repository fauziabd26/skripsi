<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class barang_paket extends Model
{
    protected $table = "barang_pakets";
	protected $primaryKey = "id";
	public $incrementing = false;
	protected $fillable = [
		'id_barang',
		'kode',
		'jumlah',
	];
	
	public function allData()
    {
        return DB::table('barang_pakets')->get();
    }
}
