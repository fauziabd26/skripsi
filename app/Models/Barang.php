<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use SoftDeletes, HasFactory;
	protected $fillable=['id','name','stok','file','kategori_id','satuan_id'];
    public function allData()
    {
        return DB::table('barangs')
        ->join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
    }
    public function addData($data)
    {
        DB::table('barangs')->insert($data);
    }
    public function editData($id, $datas)
    {
        DB::table('barangs')
        ->where('id',$id)
        ->update($datas);
    }
    public function barang_masuks()
    {
        return $this->hasMany('App\Models\BarangMasuk');
    }
    protected $hidden;


}
