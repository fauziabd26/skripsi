<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BarangImport implements ToModel, WithHeadingRow, WithStartRow
{
    use Importable;
    protected $kategoris;
    
    public function startRow():int
    {
        return 2;
    }

    public function __construct($kategori)
    {
        $this->kategoris = $kategori;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $satuan = Satuan::where('name', $row['satuan'])->first();
        if($row['nama_barang']!= NULL){
            if($satuan==NULL)
            {
                $data = new Satuan();
                $data->id = Uuid::uuid4()->getHex();
                $data->name = $row['satuan'];
                $data->save();
            }
            return new Barang([
                'id'    => Uuid::uuid4()->getHex(), 
                'name'  => $row['nama_barang'],
                'stok'  => $row['2020']+$row['2021'],
                'kategori_id' => $this->kategoris->id ?? NULL, 
                'satuan_id' => $satuan->id ?? NULL, 
            ]);
        }
    }
}
