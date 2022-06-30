<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\aproval;
use App\Models\kondisi;
use App\Models\peminjaman;
use App\Models\pengembalian;
use App\Models\paket;
use App\Models\peminjaman_paket;
use App\Models\barang_paket;
use App\Models\barang_peminjaman;
use Illuminate\Http\Request;
use DB;
use Session;
use Ramsey\Uuid\Uuid;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	  public function __construct()
    {
        $this->aproval = new aproval();
    }
    public function index()
    {
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
        return view('Pengguna.Mahasiswa.Peminjaman.index', compact('barang'));
    }
	
	 public function indexdosen()
    {
        $data = aproval::join('users', 'users.id', '=', 'aprovals.nama_peminjam')
        ->get(['aprovals.*', 'users.id as id_Mahasiswa']);
        $peminjaman = barang_peminjaman::allData();
		$mahasiswa = Mahasiswa::join('users', 'users.mahasiswa_id', '=', 'mahasiswas.id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
        return view('Pengguna.Dosen.index', compact('data','peminjaman','barang','mahasiswa'));
    }
	
	public function indexaproval()
    {
       $data = aproval::get();
       return view('Aproval.index', compact('data'));
    }
	
	public function indexPengembalian(){
		$data = peminjaman::get();
		$data1 = kondisi::get();
		return view('Pengguna.Mahasiswa.Pengembalian.index', compact('data','data1'));
	}
	public function indexpaket()
    {
       $data = paket::get();
       $barang = barang::get();
       $pbarang = barang_paket::get();
       return view('Pengguna.Mahasiswa.Peminjaman.paket', compact('data','pbarang','barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Barang = Barang::get();
		$dosen = Dosen::join('users', 'users.dosen_id', '=', 'dosens.id')
		->get(['dosens.*', 'users.id as id_dosen']);
		$mahasiswa = Mahasiswa::join('users', 'users.mahasiswa_id', '=', 'mahasiswas.id')
		->get(['mahasiswas.*', 'users.id as id_Mahasiswa']);
		return view('Pengguna.Mahasiswa.Peminjaman.addBanyak', compact('Barang','dosen','mahasiswa'));
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
				'n_peminjam'       			=> 'required',
				'namaDosen'       			=> 'required',
				't_peminjaman'         		=> 'required',
				'w_peminjaman'         		=> 'required',
				],[
					'n_peminjam.required'       =>'Nama Tidak Boleh Kosong',
					'namaDosen.required'   		=>'Nama dosen Tidak Boleh Kosong',
					't_peminjaman.required' 	=>'Tanggal Peminjaman Tidak Boleh Kosong',
					'w_peminjaman.required' 	=>'Waktu Peminjaman Tidak Boleh Kosong',
		
				]);
		foreach ($request->namaBarang as $key => $value) {
			$barang0 = barang::findorfail($value);
			$barang1 = $barang0->stok - $request->jumlahBarang[$key];
		}
		if ($barang0->stok != 0 && $barang1 >= 0){
		$kode = barang_peminjaman::max('kode');
		$aproval = new aproval();
        $aproval->id = Uuid::uuid4()->getHex();
		$aproval->nama_peminjam = $request->n_peminjam;
		$aproval->id_dosen = $request->namaDosen;
		$aproval->tanggal_peminjaman = $request->t_peminjaman;
		$aproval->waktu_peminjaman = $request->w_peminjaman;
		if(!empty($kode)){
			$aproval->kode_barang_peminjaman = $kode+1;
		}if(empty($kode)){
			$aproval->kode_barang_peminjaman = 1;
		}
		foreach ($request->namaBarang as $key => $value) {
			if($request->namaBarang[$key] != "" && $request->jumlahBarang[$key] != ""){
			$barang_peminjaman = new barang_peminjaman();
			$barang = barang::findorfail($value);
			$barang->stok -= $request->jumlahBarang[$key];
			$barang->save();
			$barang_peminjaman->id = Uuid::uuid4()->getHex();
			$barang_peminjaman->id_barang = $request->namaBarang[$key];
			if(!empty($kode)){
			$barang_peminjaman->kode = $kode+1;
			}if(empty($kode)){
			$barang_peminjaman->kode = 1;
			}
			$barang_peminjaman->jumlah = $request->jumlahBarang[$key];
			$barang_peminjaman->save();
			}
			else{
				Session::flash('gagal','Data barang tidak boleh kosong');
				return redirect()->back();
			}
		}
		
		Session::flash('sukses','Data Berhasil Terkirim');
		}
		else{
			Session::flash('gagal','Maaf Barang Sedang Tidak ada atau kurang');
			return redirect()->back();
		}
		$aproval->save();
		return redirect('PenggunaMahasiswa');
    }
	
	public function storedosen(Request $request,$id)
    {
        $peminjaman = new peminjaman;
		$peminjaman->id = Uuid::uuid4()->getHex();
		$peminjaman->kode_barang_peminjaman = $request->k_barang;
		$peminjaman->id_dosen = $request->id_dosen;
		$peminjaman->nama_peminjam = $request->n_peminjam;
		$peminjaman->tanggal_peminjaman = $request->t_peminjaman;
		$peminjaman->waktu_peminjaman = $request->w_peminjaman;
		$peminjaman->aprovals = $request->aproval;
		$peminjaman->status = $request->status;
		$peminjaman->save();
		
		$del = aproval::findorfail($id);
		$del->delete();
		
		Session::flash('sukses','Data Berhasil disetujui dan Terkirim');
		return redirect('PenggunaDosen');
    }
	
	public function storeaproval(Request $request,$id)
    {
        peminjaman::create([
			'kode_barang' => $request->k_barang,
			'nama_barang' => $request->n_barang,
			'kategori_barang' => $request->kategori_b,
			'satuan_barang' => $request->s_barang,
			'nama_peminjam' => $request->n_peminjam,
			'jumlah_peminjam' => $request->j_peminjam,
			'tanggal_peminjaman' => $request->t_peminjaman,
			'waktu_peminjaman' => $request->w_peminjaman,
			'aprovals' => $request->aproval,
			
		]);
		
		Session::flash('sukses','Data Berhasil disetujui dan Terkirim');
		return redirect('PenggunaDosen');
    }
	
	public function storepengembalian(Request $request)
    {
        pengembalian::create([
			'nama_barang' => $request->n_barang,
			'nama_peminjam' => $request->n_peminjam,
			'jumlah_pengembalian' => $request->j_Pengembalian,
			'tanggal_peminjaman' => $request->t_peminjaman,
			'waktu_peminjaman' => $request->w_peminjaman,
			'tanggal_pengembalian' => $request->t_Pengembalian,
			'kondisi' => $request->kondisi,
			
		]);
		Session::flash('sukses','Data Pengembalian Berhasil Terkirim');
		return redirect('PenggunaMahasiswaPengembalian');
    }

	public function storepaket(Request $request, $id)
    {
		$paket = paket::findorfail($id);
		$ifjumlah = $paket->jumlah - $request->j_peminjam;
		if($ifjumlah >= 0){
			$paket->jumlah -= $request->j_peminjam;
			$peminjaman_paket = new peminjaman_paket;
			$peminjaman_paket->id = Uuid::uuid4()->getHex();
			$peminjaman_paket->kode_paket = $request->k_paket;
			$peminjaman_paket->nama_peminjam = $request->n_peminjam;
			$peminjaman_paket->jumlah_peminjaman = $request->j_peminjam;
			$peminjaman_paket->tanggal_peminjaman = $request->t_peminjaman;
			$peminjaman_paket->waktu_peminjaman = $request->w_peminjaman;
			$paket->save();
			$peminjaman_paket->save();
		}
		else{
			Session::flash('gagal','Maaf Barang Sedang Tidak ada atau kurang');
			return redirect()->back();
		}
		Session::flash('sukses','Data Pengembalian Berhasil Terkirim');
		return redirect('PenggunaMahasiswapaket');
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
    public function edit(barang $barang, $id)
    {
		$kem = barang::findOrFail($id);
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
		return view('Pengguna.Mahasiswa.Peminjaman.edit', compact('kem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroyAproval($id)
    {
		$del = aproval::findorfail($id);
		$kode = $del->kode_barang_peminjaman;
		$barang_peminjaman = barang_peminjaman::all();
		foreach ($barang_peminjaman as $key => $value) {
			if($value->kode == $kode){
				$id_barang = $value->id_barang;
				$barang = Barang::findorfail($id_barang);
				$barang->stok += $value->jumlah;
				$barang->save();
			}
		}
		foreach ($barang_peminjaman as $key => $value) {
			if($value->kode == $kode){
				$value->delete();
			}
		}
		$del->delete();
		return redirect('PenggunaDosen');
    }
	
}
