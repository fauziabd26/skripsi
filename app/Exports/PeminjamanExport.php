<?php

namespace App\Exports;

use App\Models\peminjaman;
use App\Models\barang_peminjaman;
use App\Models\Barang;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PeminjamanExport implements FromView, ShouldAutoSize
{
    
    use Exportable;

    protected $tglawal, $tglakhir;

    public function __construct(String $tglawal, String $tglakhir) {

        $this->tglawal = $tglawal;
        $this->tglakhir = $tglakhir;
    }


    public function view(): View
    {
        return view('peminjaman.cetakexcel', [
            'peminjaman' => peminjaman::whereDate('tanggal_peminjaman', '>=', $this->tglawal)
                   ->whereDate('tanggal_peminjaman', '<=', $this->tglakhir)
                   ->get(),
            'barangP' => barang_peminjaman::all(),
            'barang' => barang::all(),
			'dosen' => Dosen::join('users', 'users.id', '=', 'dosens.user_id')
			->get(['dosens.*', 'users.id as Dosen_id']),
			'mahasiswa' => Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
			->get(['mahasiswas.*', 'users.id as Mahasiswa_id']),
			]);
    }


}
