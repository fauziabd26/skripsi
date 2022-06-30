<?php

namespace App\Exports;

use App\Models\Barang;
use App\Models\peminjaman_paket;
use App\Models\paket;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PaketExport implements FromView, ShouldAutoSize
{
    
    use Exportable;

    protected $tglawal, $tglakhir;

    public function __construct(String $tglawal, String $tglakhir) {

        $this->tglawal = $tglawal;
        $this->tglakhir = $tglakhir;
    }


    public function view(): View
    {
        return view('peminjaman.cetakexcelpaket', [
            'peminjaman' => peminjaman_paket::whereDate('tanggal_peminjaman', '>=', $this->tglawal)
                   ->whereDate('tanggal_peminjaman', '<=', $this->tglakhir)
                   ->get(),
            'paket' => paket::all(),
        ]);
    }


}
