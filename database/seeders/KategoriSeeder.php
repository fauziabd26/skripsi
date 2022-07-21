<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Kategori();
        $data->id = Uuid::uuid4()->getHex();
        $data->name = "Bahan";
        $data->save();

        $data = new Kategori();
        $data->id = Uuid::uuid4()->getHex();
        $data->name = "Alat";
        $data->save();
    }
}
