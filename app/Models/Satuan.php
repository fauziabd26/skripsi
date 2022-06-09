<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Satuan extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected $table = 'satuans';
    protected $fillable = [
        'id', 'name' 
    ];
    public function barang()
    {
        return $this->hasMany(Barang::class);
    }

}
