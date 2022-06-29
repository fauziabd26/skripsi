<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class BarangMasuk extends Model
{
    use SoftDeletes, HasFactory;
    public $incrementing = false;
    protected $table="barang_masuks";
	protected $fillable=['id','tggl_masuk','stok_awal','nama_konsumen','barang_id'];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
}
