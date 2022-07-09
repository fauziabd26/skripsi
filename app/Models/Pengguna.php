<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengguna extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'mahasiswa_id',
        'dosen_id',
        'role_id',
        
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}