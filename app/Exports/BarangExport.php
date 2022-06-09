<?php

namespace App\Exports;

use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BarangExport implements FromView, ShouldAutoSize
{
    
    use Exportable;

    protected $tglawal, $tglakhir;

    public function __construct(String $tglawal, String $tglakhir) {

        $this->tglawal = $tglawal;
        $this->tglakhir = $tglakhir;
    }


    public function view(): View
    {
        return view('barang.cetakexcel', [
            'barang' => Barang::whereDate('created_at', '>=', $this->tglawal)
                   ->whereDate('created_at', '<=', $this->tglakhir)
                   ->get(),
        ]);
    }


}
