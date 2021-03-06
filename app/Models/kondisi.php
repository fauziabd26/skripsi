<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kondisi extends Model
{
    protected $table = "kondisis";
	protected $primaryKey = "id";
	public $incrementing = false;
	protected $fillable = [
		'name',
	];
	public function allData()
    {
        return DB::table('kondisis')->get();
    }
}
