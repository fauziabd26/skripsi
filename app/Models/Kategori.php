<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kategori extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected $table = 'kategoris';
    protected $fillable = [
        'id', 'name' 
    ];
    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
