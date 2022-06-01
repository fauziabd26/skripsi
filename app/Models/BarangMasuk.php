<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class BarangMasuk extends Model
{
    use SoftDeletes, HasFactory;
    protected $hidden;
    protected $table="barang_masuks";
	protected $primaryKey="id_barang_masuk";
	protected $fillable=['id_barang_masuk','tggl_masuk','stok_awal','nama_konsumen','barang_id'];

	public $timestamps = false;

    public function barangs()
    {
        return $this->belongsTo('App\Models\Barang');
    }
    public function editData($id, $datas)
    {
        DB::table('barang_masuks')
        ->where('id',$id)
        ->update($datas);
    }
}
