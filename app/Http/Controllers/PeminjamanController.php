<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\peminjaman;
use App\Models\paket;
use App\Models\peminjaman_paket;
use App\Models\barang_paket;
use App\Models\barang_peminjaman;
use Illuminate\Http\Request;
use DB;
use Session;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanExport;
use App\Exports\PaketExport;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = peminjaman::join('users', 'users.id', '=', 'peminjamans.nama_peminjam')
        ->get(['peminjamans.*', 'users.id as id_Mahasiswa']);
		$dosen = Dosen::join('users', 'users.dosen_id', '=', 'dosens.id')
		->get(['dosens.*', 'users.id as Dosen_id']);
		$mahasiswa = Mahasiswa::join('users', 'users.mahasiswa_id', '=', 'mahasiswas.id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
        $peminjaman = barang_peminjaman::get();
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
        return view('Peminjaman.index', compact('data','peminjaman','barang','mahasiswa','dosen'));
    }
	
	public function indexpaket()
    {
       $data = peminjaman_paket::get();
	   $paket = paket::get();
       $barang = barang::get();
       $pbarang = barang_paket::get();
       return view('Peminjaman.paket', compact('data','pbarang','barang','paket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$dosen = Dosen::join('users', 'users.id', '=', 'dosens.user_id')
		->get(['dosens.*', 'users.id as user_id']);
		$mahasiswa = Mahasiswa::join('users', 'mahasiswas.user_id', '=', 'users.id')
		->get(['mahasiswas.*', 'users.id as user_id']);
        $kategoris = kategori::get();
		$satuans = Satuan::get();
		$Barang = Barang::get();
		return view('peminjaman.add', compact('kategoris','satuans','Barang','dosen','mahasiswa'));
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
				'nama_peminjam'       			=> 'required',
				'tanggal_peminjaman'       		=> 'required',
				'waktu_peminjaman'         		=> 'required',
				],[
					'nama_peminjam.required'       	=>'Nama Tidak Boleh Kosong',
					'tanggal_peminjaman.required'   =>'Tanggal Tidak Boleh Kosong',
					'waktu_peminjaman.required' 	=>'Waktu Peminjaman Tidak Boleh Kosong',
		
				]);
		foreach ($request->namaBarang as $key => $value) {
			$barang0 = barang::findorfail($value);
			$barang1 = $barang0->stok - $request->jumlahBarang[$key];
		}
		if ($barang0->stok != 0 && $barang1 >= 0){
		$kode = barang_peminjaman::max('kode');
		$peminjaman = new peminjaman();
        $peminjaman->id = Uuid::uuid4()->getHex();
		$peminjaman->id_dosen = $request->namaDosen;
		$peminjaman->nama_peminjam = $request->nama_peminjam;
		$peminjaman->tanggal_peminjaman = $request->tanggal_peminjaman;
		$peminjaman->waktu_peminjaman = $request->waktu_peminjaman;
		$peminjaman->status = $request->status;
		$peminjaman->aprovals = $request->aproval;
		if(!empty($kode)){
			$peminjaman->kode_barang_peminjaman = $kode+1;
		}if(empty($kode)){
			$peminjaman->kode_barang_peminjaman = 1;
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
			Session::flash('gagal','Data peminjaman kurang atau tidak ada');
		}
		$peminjaman->save();
		return redirect('Peminjaman');
    }
	
	public function storepaket(Request $request)
    {
        peminjaman::create([
			'kode_barang' => $request->kode_barang,
			'nama_barang' => $request->nama_barang,
			'kategori_barang' => $request->kategori_barang,
			'satuan_barang' => $request->satuan_barang,
			'nama_peminjam' => $request->nama_peminjam,
			'jumlah_peminjam' => $request->jumlah_peminjam,
			'tanggal_peminjaman' => $request->tanggal_peminjaman,
			'waktu_peminjaman' => $request->waktu_peminjaman,
			'aprovals' => $request->aprovals,
			
		]);
		Session::flash('sukses','Data peminjaman Berhasil Ditambah');
		return redirect('Peminjaman');
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
        $kem = peminjaman::findorfail($id);
		$dosen = Dosen::join('users', 'users.dosen_id', '=', 'dosens.id')
		->get(['dosens.*', 'users.id as Dosen_id']);
		$mahasiswa = Mahasiswa::join('users', 'users.mahasiswa_id', '=', 'mahasiswas.id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
        $peminjaman = barang_peminjaman::join('barangs', 'barangs.id', '=', 'barang_peminjamans.id_barang')
        ->get(['barang_peminjamans.*', 'barangs.name as b_name', 'barangs.id as b_id']);
		return view('peminjaman.edit', compact('kem','peminjaman','barang','dosen','mahasiswa'));
    }
	
    public function editPaket($id)
    {
        $kem = peminjaman_paket::findorfail($id);
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
        $paket = paket::all();
		return view('peminjaman.editPaket', compact('kem','paket','barang'));
    }
	public function editPaketpos(Request $request, $id)
    {
        $kem = peminjaman_paket::findorfail($id);
		$idP = $kem->kode_paket;
		$idP1 = $request->nama_paket;
		
		if ($kem->kode_paket == $request->nama_paket){
			$paket = paket::findorfail($idP);
			$jpp = $kem->jumlah_peminjaman - $request->jumlahPaket;
			$paket->jumlah += $jpp;
			$paket->save();
		}
		else{
			$paket1 = paket::findorfail($idP);
			$paket1->jumlah += $kem->jumlah_peminjaman;
			$paket1->save();
			
			$paket2 = paket::findorfail($idP1);
			$paket2->jumlah -= $request->jumlahPaket;
			$paket2->save();
		}
		$kem->kode_paket = $request->nama_paket;
		$kem->nama_peminjam = $request->nama_peminjam;
		$kem->jumlah_peminjaman = $request->jumlahPaket;
		$kem->tanggal_peminjaman = $request->tanggal_peminjaman;
		$kem->waktu_peminjaman = $request->waktu_peminjaman;
        
		$kem->save();
		Session::flash('sukses','Data peminjaman Berhasil Ditambah');
		return redirect('PeminjamanPaket');
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
		
		foreach ($request->id_bp as $key => $value) {
			Request()->validate([
				'nama_peminjam'       			=> 'required',
				'tanggal_peminjaman'       		=> 'required',
				'waktu_peminjaman'         		=> 'required',
				'jumlahBarang1'   				=> 'required',
				'namaBarang1'     				=> 'required',
				'aprovals'   					=> 'required',
				'status'     					=> 'required',
				],[
					'nama_peminjam.required'       	=>'Nama Tidak Boleh Kosong',
					'tanggal_peminjaman.required'   =>'Tanggal Tidak Boleh Kosong',
					'jumlahBarang1.required'     	=>'Jumlah Barang Tidak Boleh Kosong',
					'waktu_peminjaman.required' 	=>'Waktu Peminjaman Tidak Boleh Kosong',
					'namaBarang1.required'   		=>'Nama Barang Atau Jumlah Barang Tidak Boleh Kosong',
					'aprovals.required' 			=>'Aproval Tidak Boleh Kosong',
					'status.required'   			=>'Status Barang Tidak Boleh Kosong',
					'dynamic_field.required'   		=>'Form Tidak Boleh Kosong',
		
				]);
		}
		$barang_peminjaman2 = barang_peminjaman::all();
		foreach ($request->id_bp as $key => $value) {
			$id_bp1 = $request->id_bp[$key];
			$barang_peminjaman3 = barang_peminjaman::findorfail($id_bp1);
			$kode1 = $barang_peminjaman3->id_barang;
			$barang0 = barang::findorfail($kode1);
			$jumlah = $barang0->stok + $barang_peminjaman3->jumlah;
			$barang1 = $jumlah - $request->jumlahBarang1[$key];
		}
		if ($barang1 >= 0){
			$kode = barang_peminjaman::all()->last();
			$kem = peminjaman::findorfail($id);
			
			$kem->id_dosen = $request->namaDosen;
			$kem->nama_peminjam = $request->nama_peminjam;
			$kem->tanggal_peminjaman = $request->tanggal_peminjaman;
			$kem->waktu_peminjaman = $request->waktu_peminjaman;
			$kem->aprovals = $request->aprovals;
			$kem->status = $request->status;
			$kem->update();
				$barang_peminjaman0 = barang_peminjaman::all();
				$barang_peminjaman1 = new barang_peminjaman();
			/**if($kem->kode_barang_peminjaman == $barang_peminjaman1->kode){/**
					$kodeid = $barang_peminjaman1->id_barang;
					$barang = barang::findorfail($kodeid);
					$stok = $barang_peminjaman1->jumlah + $barang->stok;
					$stok1 = $stok - $request->jumlahBarang1[$key];
					$barang->stok = $stok1;
					$barang->save();*/
				//$barang_peminjaman00 = barang_peminjaman::all();
				foreach ($request->namaBarang1 as $key => $value) {
					$kem2 = $request->id_bp[$key];
					$barang_p1 = barang_peminjaman::findorfail($kem2);
					$idb = $barang_p1->id_barang;
					$idb1 = $request->namaBarang1[$key];
					$barang = barang::findorfail($value);
						if($request->namaBarang1[$key] != $barang_p1->id_barang){
							$iftiga = $barang->stok - $request->jumlahBarang1[$key];
							if ($iftiga >= 0){
								$barang00 = barang::findorfail($idb);
								$barang_p2 = $barang_p1->jumlah;
								$barang00->stok += $barang_p2;
								$barang00->save();
								$barang000 = barang::findorfail($idb1);
								$barang000->stok -= $barang_p2;
								$barang000->save();
							}
							else{
								Session::flash('gagal','Data barang kurang atau tidak ada');
								return redirect()->back();
							}
						}
						else{
							$jumlah1 = $barang->stok + $barang_p1->jumlah;
							$barang1 = $jumlah1 - $request->jumlahBarang1[$key];
							$barang->stok = $barang1;
							$barang->save();
						}
						
				}
				foreach ($request->id_bp as $key => $value) {
					if($request->namaBarang1[$key] != "" && $request->jumlahBarang1[$key] != ""){
					$kem1 = $request->id_bp[$key];
					$barang_p = barang_peminjaman::findorfail($kem1);
					$barang_p->id = Uuid::uuid4()->getHex();
					$barang_p->id_barang = $request->namaBarang1[$key];
					$barang_p->jumlah = $request->jumlahBarang1[$key];
					$barang_p->save();
					}
					else{
						Session::flash('kosong','Nama dan Jumlah barang tidak disimpan karena ada yang Kosong');
						return redirect()->back();
					}
				}
			
			if(!empty($request->namaBarang)){
				foreach ($request->namaBarang as $key => $value) {
					$barang_peminjaman = new barang_peminjaman();
					$barang_peminjaman4 = barang_peminjaman::all();
					$kem1 = peminjaman::findorfail($id);
					$bkem = $kem1->kode_barang_peminjaman;
					$barang = barang::findorfail($value);
					$barang->stok -= $request->jumlahBarang[$key];
					$barang->save();
					$barang_peminjaman->id_barang = $request->namaBarang[$key];
					$barang_peminjaman->kode = $request->kode_bp;
					$barang_peminjaman->jumlah = $request->jumlahBarang[$key];
					$barang_peminjaman->save();
				}
			}
			Session::flash('sukses','Data Berhasil di Edit');
		}
		else{
			Session::flash('gagal','Data peminjaman kurang atau tidak ada');
			return redirect()->back();
		}
        return redirect('Peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
	 
	 
    public function indexlaporan()
    {
        $peminjaman = peminjaman::all();
        $barangP = barang_peminjaman::all();
		$barang = barang::all();
		$dosen = Dosen::join('users', 'users.dosen_id', '=', 'dosens.id')
		->get(['dosens.*', 'users.id as Dosen_id']);
		$mahasiswa = Mahasiswa::join('users', 'users.mahasiswa_id', '=', 'mahasiswas.id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
        return view('laporan.indexPeminjaman', compact('barangP','peminjaman','barang','dosen','mahasiswa'));
    }
	public function indexlaporanPaket()
    {
        $peminjaman = peminjaman_paket::all();
        $paket = paket::all();
        return view('laporan.indexPaket', compact('paket','peminjaman'));
    }
    public function cetakpertanggal(Request $request)
    {        
        $tglawal=$request->tglawal;
        $tglakhir=$request->tglakhir;
        $peminjaman = peminjaman::whereBetween('tanggal_peminjaman',[$request->tglawal, $request->tglakhir])
        ->latest()
        ->get();
        $barangP = barang_peminjaman::all();
		$barang = barang::all();
		$dosen = Dosen::join('users', 'users.dosen_id', '=', 'dosens.id')
		->get(['dosens.*', 'users.id as Dosen_id']);
		$mahasiswa = Mahasiswa::join('users', 'users.mahasiswa_id', '=', 'mahasiswas.id')
		->get(['mahasiswas.*', 'users.id as Mahasiswa_id']);
        
        return view('Peminjaman.cetakpdf', compact('barangP','peminjaman','barang','tglawal','tglakhir','dosen','mahasiswa'));            
        
    }
	
    public function export(Request $request) 
    {
        $tglawal=$request->tglawal;
        $tglakhir=$request->tglakhir;
        $peminjaman = peminjaman::whereBetween('tanggal_peminjaman',[$request->tglawal, $request->tglakhir])
        ->latest()
        ->get();
    
        return Excel::download(new PeminjamanExport($tglawal, $tglakhir), 'Laporan peminjaman.xlsx');
    }
	
	
    public function cetakpertanggalpaket(Request $request)
    {        
        $tglawal=$request->tglawal;
        $tglakhir=$request->tglakhir;
        $peminjaman = peminjaman_paket::whereBetween('tanggal_peminjaman',[$request->tglawal, $request->tglakhir])
        ->latest()
        ->get();
        $paket = paket::all();
        
        return view('Peminjaman.cetakpdfpaket', compact('paket','peminjaman','tglawal','tglakhir'));            
        
    }
	
    public function exportpaket(Request $request) 
    {
        $tglawal=$request->tglawal;
        $tglakhir=$request->tglakhir;
        $peminjaman = peminjaman_paket::whereBetween('tanggal_peminjaman',[$request->tglawal, $request->tglakhir])
        ->latest()
        ->get();
    
        return Excel::download(new PaketExport($tglawal, $tglakhir), 'Laporan peminjaman Paket.xlsx');
    }
	 
	 public function destroypeminjamanbarang($id)
    {
		$del = barang_peminjaman::findorfail($id);
		$barang1 = barang::all();
		foreach ($barang1 as $key => $value) {
			$kode = $del->id_barang;
			if($value->id == $kode){
				$value->stok += $del->jumlah;
				$value->save();
			}
		}
		$del->delete();
		return redirect()->back();
    }
	
	 public function destroypeminjamanpaket($id)
    {
		$del = peminjaman_paket::findorfail($id);
		$paket = paket::all();
		foreach ($paket as $key => $value) {
			$kode = $del->kode_paket;
			if($value->id == $kode){
				$value->jumlah += $del->jumlah_peminjaman;
				$value->save();
			}
		}
		$del->delete();
		return redirect()->back();
    }
	 
    public function destroy($id)
    {
		$del = peminjaman::findorfail($id);
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
		return redirect('Peminjaman');
    }
}
