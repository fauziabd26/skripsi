<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected $table = 'dosens';
    protected $fillable = [
        'id', 'nip', 'name', 'keterangan' 
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
