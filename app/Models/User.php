<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, HasFactory, HasApiTokens;
    public $incrementing = false;
    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role_id',
        
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
