<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Satuan();
        $data->id = Uuid::uuid4()->getHex();
        $data->name = "Unit";
        $data->save();
    }
}
