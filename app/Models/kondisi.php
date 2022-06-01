<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kondisi extends Model
{
    protected $table = "kondisis";
	protected $primaryKey = "id";
	protected $fillable = [
		'name',
	];
	public function allData()
    {
        return DB::table('kondisis')->get();
    }
}
