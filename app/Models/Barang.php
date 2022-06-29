<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use SoftDeletes, HasFactory;
    public $incrementing = false;
    protected $table = 'barangs';
    protected $fillable=[
        'id','name','stok','file','kategori_id','satuan_id', 'created_at', 'updated_at'
    ];

    public function editData($id, $datas)
    {
        DB::table('barangs')
        ->where('id',$id)
        ->update($datas);
    }
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
        return $this->belongsTo(BarangMasuk::class);
    }
}
