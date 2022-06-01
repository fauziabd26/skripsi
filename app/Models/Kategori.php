<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class kategori extends Model
{
    use HasFactory, SoftDeletes;
    public function addData($data)
    {
        DB::table('kategoris')->insert($data);
    }
    protected $hidden;

}
