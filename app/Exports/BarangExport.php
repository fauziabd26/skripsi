<?php

namespace App\Exports;

use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BarangExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function __construct(int $year, int $month)
    {
        $this->year  = $year;
        $this->month = $month;
    }
    public function view(): View
    {
        
        return view('laporan.index',[
            'barang' => Barang::all()
        ]);
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    /* public function collection()
    {
        return Laporan::all();
    } */
}
