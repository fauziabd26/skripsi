<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\aproval;
use App\Models\kondisi;
use App\Models\peminjaman;
use App\Models\pengembalian;
use Illuminate\Http\Request;
use DB;
use Session;;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengembalianExport;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\barang_peminjaman;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pengembalian::join('peminjamans', 'peminjamans.id', '=', 'pengembalians.peminjaman_id')
        ->join('kondisis', 'kondisis.id', '=', 'pengembalians.kondisi_id')
        ->get(['pengembalians.*', 'peminjamans.id as id_Peminjaman', 'kondisis.name as id_kondisi', 'kondisis.id as idkondisi']);
		$data1 = kondisi::get();
		
		$jumlah_pengembalian = pengembalian::all();
		
		$mahasiswa = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
		$dosen = Dosen::join('users', 'users.id', '=', 'dosens.user_id')
		->get(['dosens.*', 'users.id as id_dosen']);
        $peminjamanbarang = barang_peminjaman::allData();
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
		$peminjaman = peminjaman::join('users', 'users.id', '=', 'peminjamans.nama_peminjam')
        ->get(['peminjamans.*', 'users.id as id_Mahasiswa']);
		
		$databarang = pengembalian::join('peminjamans', 'peminjamans.id', '=', 'pengembalians.peminjaman_id')
        ->join('barang_peminjamans', 'barang_peminjamans.kode', '=', 'peminjamans.kode_barang_peminjaman')
        ->join('barangs','barangs.id','=','barang_peminjamans.id_barang')
		->where('peminjamans.status', '=', 'Dipinjam')
        ->get(['peminjamans.*','barangs.name as nama_barang','barang_peminjamans.jumlah as jumlah_barang']);
		
			Session::flash('jumlah','Data Pengembalian Tidak Sesuai');
		
        return view('Pengembalian.index', compact('data','data1','mahasiswa','dosen','peminjamanbarang','barang','peminjaman','databarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$mahasiswa = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
		$dosen = Dosen::join('users', 'users.id', '=', 'dosens.user_id')
		->get(['dosens.*', 'users.id as id_dosen']);
        $peminjaman = barang_peminjaman::allData();
		$data = peminjaman::join('users', 'users.id', '=', 'peminjamans.nama_peminjam')
        ->get(['peminjamans.*', 'users.id as id_Mahasiswa']);
		$data1 = kondisi::get();
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
		return view('Pengembalian.add', compact('data','data1','mahasiswa','dosen','peminjaman','barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			Request()->validate([
				't_Pengembalian'       			=> 'required',
				'j_Pengembalian'       			=> 'required',
				'kondisi'         				=> 'required',
				],[
					't_Pengembalian.required'       =>'Tanggal Tidak Boleh Kosong',
					'j_Pengembalian.required'   	=>'Jumlah Tidak Boleh Kosong',
					'kondisi.required' 				=>'Kondisi Tidak Boleh Kosong',
				]);
        $pengembalian = new pengembalian;
		$pengembalian->id = Uuid::uuid4()->getHex();
		$pengembalian->peminjaman_id = $request->n_peminjam;
		$pengembalian->tanggal_pengembalian = $request->t_Pengembalian;
		$pengembalian->jumlah_pengembalian = $request->j_Pengembalian;
		$pengembalian->kondisi_id = $request->kondisi;
		
		$id_peminjaman = $request->n_peminjam;
		
		$peminjaman = peminjaman::findorfail($id_peminjaman);
		$peminjaman->status = "Dikembalikan";
		
		$peminjaman->save();
		$pengembalian->save();
		
		Session::flash('sukses','Data Pengembalian Berhasil Terkirim');
		return redirect()->back();
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kem = pengembalian::findorfail($id);
		$data = kondisi::get();
		return view('Pengembalian.edit', compact('kem','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
			Request()->validate([
				't_Pengembalian'       			=> 'required',
				'j_Pengembalian'       			=> 'required',
				'kondisi'         				=> 'required',
				],[
					't_Pengembalian.required'       =>'Tanggal Tidak Boleh Kosong',
					'j_Pengembalian.required'   	=>'Jumlah Tidak Boleh Kosong',
					'kondisi.required' 				=>'Kondisi Tidak Boleh Kosong',
				]);
		$kem = pengembalian::findorfail($id);
		$kem->tanggal_pengembalian = $request->t_Pengembalian;
		$kem->jumlah_pengembalian = $request->j_Pengembalian;
		$kem->kondisi_id = $request->kondisi;
		
        $kem->update();
		Session::flash('sukses','Data Berhasil di Edit');
        return redirect('Pengembalian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
	 
	 
    public function indexlaporan()
    {
        $data = pengembalian::join('peminjamans', 'peminjamans.id', '=', 'pengembalians.peminjaman_id')
        ->join('kondisis', 'kondisis.id', '=', 'pengembalians.kondisi_id')
        ->get(['pengembalians.*', 'peminjamans.id as id_Peminjaman', 'kondisis.name as id_kondisi', 'kondisis.id as idkondisi']);
		$data1 = kondisi::get();
		$mahasiswa = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
		$dosen = Dosen::join('users', 'users.id', '=', 'dosens.user_id')
		->get(['dosens.*', 'users.id as id_dosen']);
        $peminjamanbarang = barang_peminjaman::allData();
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
		$peminjaman = peminjaman::join('users', 'users.id', '=', 'peminjamans.nama_peminjam')
        ->get(['peminjamans.*', 'users.id as id_Mahasiswa']);
        return view('laporan.indexPengembalian', compact('data','data1','mahasiswa','dosen','peminjamanbarang','barang','peminjaman'));
    }
	
	
    public function cetakpertanggal(Request $request)
    {        
        $tglawal=$request->tglawal;
        $tglakhir=$request->tglakhir;
        $pengembalian = pengembalian::whereBetween('tanggal_pengembalian',[$request->tglawal, $request->tglakhir])
        ->latest()->join('peminjamans', 'peminjamans.id', '=', 'pengembalians.peminjaman_id')
        ->join('kondisis', 'kondisis.id', '=', 'pengembalians.kondisi_id')
        ->get(['pengembalians.*', 'peminjamans.id as id_Peminjaman', 'kondisis.name as id_kondisi', 'kondisis.id as idkondisi']);
		$peminjaman = peminjaman::join('users', 'users.id', '=', 'peminjamans.nama_peminjam')
        ->get(['peminjamans.*', 'users.id as id_Mahasiswa']);
        $peminjamanbarang = barang_peminjaman::all();
		$barang = barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
		$dosen = Dosen::join('users', 'users.id', '=', 'dosens.user_id')
		->get(['dosens.*', 'users.id as Dosen_id']);
		$mahasiswa = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
        
        return view('Pengembalian.cetakpdf', compact('peminjaman','peminjamanbarang','pengembalian','barang','tglawal','tglakhir','dosen','mahasiswa'));            
        
    }
	
    public function export(Request $request) 
    {
        $tglawal=$request->tglawal;
        $tglakhir=$request->tglakhir;
        $pengembalian = pengembalian::whereBetween('tanggal_pengembalian',[$request->tglawal, $request->tglakhir])
        ->latest()
        ->get();
		
        return Excel::download(new PengembalianExport($tglawal, $tglakhir), 'Laporan_Pengembalian.xlsx');
    }
	
    public function destroy($id)
    {
        $del = pengembalian::findorfail($id);
		$idsementara = $del->peminjaman_id;
        $peminjaman = peminjaman::findorfail($idsementara);
		$peminjaman->status = "Dipinjam";
		
		$peminjaman->save();
		$del->delete();
		return redirect('Pengembalian');
    }
}
