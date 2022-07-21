<?php

namespace Database\Seeders;

use App\Models\Kondisi;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class KondisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Kondisi();
        $data->id = Uuid::uuid4()->getHex();
        $data->name = "Baik";
        $data->save();
        
        $data = new Kondisi();
        $data->id = Uuid::uuid4()->getHex();
        $data->name = "Rusak";
        $data->save();

        $data = new Kondisi();
        $data->id = Uuid::uuid4()->getHex();
        $data->name = "Hilang";
        $data->save();


    }
}
