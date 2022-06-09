<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    use Importable;
    protected $kategoris;
    protected $satuans;

    public function __construct()
    {
        $this->kategoris = Kategori::select('id', 'name')->get();
        $this->satuans = Satuan::select('id', 'name')->get();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $kategori = $this->kategoris->where('kategori_id', $row['kategori_id'])->first();
        $satuan = $this->satuans->where('satuan_id', $row['satuan_id'])->first();
        return new Barang([
            'id'    => Uuid::uuid4()->getHex(), 
            'name'  => $row['name'],
            'stok'  => $row['stok'],
            'kategori_id' => $kategori->id ?? NULL, 
            'satuan_id' => $satuan->id ?? NULL, 
        ]);
    }
}
