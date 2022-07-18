<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
use App\Models\barang_pengembalian;
use Illuminate\Http\Request;
use DB;
use Session;
use Ramsey\Uuid\Uuid;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BarangResource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PenggunaAPIController extends Controller
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
    public function indexAPI()
    {
        $data = [
                'Barang' => Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
							->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
							->get(['barangs.*', 'kategoris.name as kategori_name', 'satuans.name as satuan_name']),
				'Dosen' => Dosen::join('users', 'users.id', '=', 'dosens.user_id')
							->get(['users.id as id_dosen','dosens.name']),
            ];
		
		
        return response()->json($data, 200);
    }
	
	 public function indexdosenAPI()
    {
		$data = aproval::join('barang_peminjamans', 'barang_peminjamans.kode', '=', 'aprovals.kode_barang_peminjaman')
        ->join('barangs','barangs.id','=','barang_peminjamans.id_barang')
        ->join('users', 'users.id', '=', 'aprovals.nama_peminjam')
        ->join('mahasiswas', 'mahasiswas.user_id', '=', 'users.id')
        ->get(['aprovals.*', 'mahasiswas.name as Nama_Mahasiswa','mahasiswas.nim as Nim_Mahasiswa','mahasiswas.kelas as Kelas_Mahasiswa','barangs.name as nama_barang','barang_peminjamans.jumlah as jumlah_barang']);
		
        return response()->json($data, 200);
    }
	
	public function indexPengembalianAPI(){
		$data = [
                'Data_Peminjaman' => peminjaman::join('users', 'users.id', '=', 'peminjamans.nama_peminjam')
							->join('mahasiswas', 'mahasiswas.user_id', '=', 'users.id')
							->join('barang_peminjamans', 'barang_peminjamans.kode', '=', 'peminjamans.kode_barang_peminjaman')
							->join('barangs','barangs.id','=','barang_peminjamans.id_barang')
							->where('peminjamans.Dikembalikan', '=', 'Belum')
							->get(['peminjamans.id as id_peminjaman','mahasiswas.name as Nama_Mahasiswa','mahasiswas.nim as Nim_Mahasiswa','mahasiswas.kelas as Kelas_Mahasiswa','peminjamans.tanggal_peminjaman as tanggal_peminjaman','peminjamans.waktu_peminjaman as waktu_peminjaman','barangs.id as id_barang','barangs.name as nama_barang','barang_peminjamans.jumlah as jumlah_peminjaman']),	
				'Data_Kondisi' => kondisi::get(),
            ];
		
		
        return response()->json($data, 200);
	}
	public function indexpaketAPI()
    {
       $data = paket::get(['pakets.id as id_paket','pakets.nama as nama_paket','pakets.kode as kode_paket', 'pakets.keterangan as keterangan_paket','pakets.jumlah as jumlah_paket']);
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAPI(Request $request)
    {
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
		$aproval->Keterangan = $request->Keterangan;
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
					return response('[404] - Data barang tidak boleh kosong');
				}
			}
		}
		else{
			return response('[404] - Maaf Barang Sedang Tidak ada atau kurang');
		}
		$aproval->save();
		return response('[200] - Data Berhasil Disimpan');
    }
	
	public function storedosenAPI(Request $request,$id)
    {
		$del = aproval::findorfail($id);
        $peminjaman = new peminjaman;
		$peminjaman->id = Uuid::uuid4()->getHex();
		$peminjaman->kode_barang_peminjaman = $request->k_barang;
		$peminjaman->id_dosen = $request->id_dosen;
		$peminjaman->nama_peminjam = $request->n_peminjam;
		$peminjaman->tanggal_peminjaman = $request->t_peminjaman;
		$peminjaman->waktu_peminjaman = $request->w_peminjaman;
		$peminjaman->aprovals = "Ya";
		$peminjaman->status = "Dipinjam";
		$peminjaman->Diserahkan = "Belum";
		$peminjaman->Dikembalikan = "Belum";
		$peminjaman->Keterangan = $del->Keterangan;
		$peminjaman->save();
		
		$del->delete();
		
		return response('[200] - Data Berhasil Disimpan');
    }
	
	public function storepengembalianAPI(Request $request)
    {
		$kode = barang_pengembalian::max('kode');
        $pengembalian = new pengembalian;
		$pengembalian->id = Uuid::uuid4()->getHex();
		$pengembalian->peminjaman_id = $request->id_peminjaman;
		$pengembalian->tanggal_pengembalian = $request->t_Pengembalian;
		$pengembalian->kondisi_id = $request->kondisi;
		if(!empty($kode)){
			$pengembalian->kode_barang_pengembalian = $kode+1;
		}if(empty($kode)){
			$pengembalian->kode_barang_pengembalian = 1;
		}
		
		
		foreach ($request->namaBarang as $key => $value) {
			$barang_pengembalian = new barang_pengembalian();
			$barang_pengembalian->id = Uuid::uuid4()->getHex();
			$barang_pengembalian->id_barang = $request->namaBarang[$key];
			if(!empty($kode)){
			$barang_pengembalian->kode = $kode+1;
			}if(empty($kode)){
			$barang_pengembalian->kode = 1;
			}
			$barang_pengembalian->jumlah = $request->j_Pengembalian[$key];
			$barang_pengembalian->save();
		}
		
		$id_peminjaman = $request->id_peminjaman;
		
		$peminjaman = peminjaman::findorfail($id_peminjaman);
		$peminjaman->status = "Dikembalikan";
		
		$peminjaman->save();
		$pengembalian->save();
		
		return response('[200] - Data Berhasil Disimpan');
    }

	public function storepaketAPI(Request $request, $id)
    {
		$paket = paket::findorfail($id);
		$ifjumlah = $paket->jumlah - $request->j_peminjam;
		if($ifjumlah >= 0){
			$paket->jumlah -= $request->j_peminjam;
			$peminjaman_paket = new peminjaman_paket;
			$peminjaman_paket->id = Uuid::uuid4()->getHex();
			$peminjaman_paket->kode_paket = $request->id_paket;
			$peminjaman_paket->nama_peminjam = $request->n_peminjam;
			$peminjaman_paket->jumlah_peminjaman = $request->j_peminjam;
			$peminjaman_paket->tanggal_peminjaman = $request->t_peminjaman;
			$peminjaman_paket->waktu_peminjaman = $request->w_peminjaman;
			$peminjaman_paket->Keterangan = $request->Keterangan;
			$paket->save();
			$peminjaman_paket->save();
		}
		else{
			return response('[200] - Maaf Barang Sedang Tidak ada atau kurang');
		}
		
		return response('[200] - Data Berhasil Disimpan');
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
    public function destroyAprovalAPI($id)
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
		return response('[200] - Data Berhasil Dihapus');
    }
    public function destroyAprovalAdmin($id)
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
