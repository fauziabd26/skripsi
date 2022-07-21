<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suppliers extends Model
{
    use SoftDeletes, HasFactory;
    public $incrementing = false;
    protected $table = 'suppliers';
    protected $fillable=[
        'id','name','alamat','email','telepon',
    ];
    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class,'suppliers_id');
    }

}
