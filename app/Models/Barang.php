<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes, HasFactory;
    public $incrementing = false;
    protected $table = 'barangs';
    protected $fillable=[
        'id','name','stok','file','kategori_id','satuan_id', 'created_at', 'updated_at'
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
    public function barangmasuk()
    {
        return $this->belongsTo('App\Models\BarangMasuk','barang_id');
    }
    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class);
    }
}
