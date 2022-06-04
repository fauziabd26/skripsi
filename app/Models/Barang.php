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
    protected $dates = ['deleted_at'];
    protected $table = 'barangs';
	protected $fillable=['id','name','stok','file','kategori_id','satuan_id'];
    
    public function allData()
    {
        return DB::table('barangs')
        ->join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
    }
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
}
