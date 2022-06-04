<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use HasFactory, SoftDeletes;
    protected $hidden;
    public $incrementing = false;
    protected $table = 'mahasiswas';
    protected $fillable = [
        'id', 'nim', 'name', 'kelas' 
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }

}
