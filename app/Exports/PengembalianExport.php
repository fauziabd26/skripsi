<?php

namespace App\Exports;

use App\Models\peminjaman;
use App\Models\pengembalian;
use App\Models\barang_peminjaman;
use App\Models\Barang;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PengembalianExport implements FromView, ShouldAutoSize
{
    
    use Exportable;

    protected $tglawal, $tglakhir;

    public function __construct(String $tglawal, String $tglakhir) {

        $this->tglawal = $tglawal;
        $this->tglakhir = $tglakhir;
    }


    public function view(): View
    {
        return view('pengembalian.cetakexcel', [
			'pengembalian' => pengembalian::whereDate('tanggal_pengembalian', '>=', $this->tglawal)->whereDate('tanggal_pengembalian', '<=', $this->tglakhir)->join('peminjamans', 'peminjamans.id', '=', 'pengembalians.peminjaman_id')->join('kondisis', 'kondisis.id', '=', 'pengembalians.kondisi_id')->get(['pengembalians.*', 'peminjamans.id as id_Peminjaman', 'kondisis.name as id_kondisi', 'kondisis.id as idkondisi']),
            'peminjaman' => peminjaman::join('users', 'users.id', '=', 'peminjamans.nama_peminjam')->get(['peminjamans.*', 'users.id as id_Mahasiswa']),
			'peminjamanbarang' => barang_peminjaman::all(),
			'barang' => barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']),
			'dosen' => Dosen::join('users', 'users.id', '=', 'dosens.user_id')->get(['dosens.*', 'users.id as Dosen_id']),
			'mahasiswa' => Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')->get(['mahasiswas.*', 'users.id as Mahasiswa_id']),
			
			]);
    }
}
