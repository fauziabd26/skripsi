<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class paket extends Model
{
    protected $table = "pakets";
	public $incrementing = false;
	protected $primaryKey = "id";
	protected $fillable = [
		'nama',
		'kode',
		'keterangan',
		'jumlah',
	];
	
	public function allData()
    {
        return DB::table('pakets')->get();
    }
}
