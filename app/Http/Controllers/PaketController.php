<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\peminjaman;
use App\Models\paket;
use App\Models\barang_paket;
use Illuminate\Http\Request;
use DB;
use Session;
use Ramsey\Uuid\Uuid;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = paket::get();
        $barang = barang::get();
        $pbarang = barang_paket::get();
        return view('Paket.index', compact('data','pbarang','barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = kategori::get();
		$satuans = Satuan::get();
		$Barang = Barang::get();
		return view('Paket.add', compact('Barang'));
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
				'namaPaket'       			=> 'required',
				'keterangan'       			=> 'required',
				'jumlahPaket'         		=> 'required',
				],[
					'namaPaket.required'       	=>'Nama Tidak Boleh Kosong',
					'keterangan.required'  	 	=>'Keterangan Tidak Boleh Kosong',
					'jumlahPaket.required'     	=>'Jumlah Paket Tidak Boleh Kosong',
				]);
		$kode = paket::max('kode');
		$paket = new paket();
        $paket->id = Uuid::uuid4()->getHex();
		$paket->nama = $request->namaPaket;
		$paket->keterangan = $request->keterangan;
		$paket->jumlah = $request->jumlahPaket;
		if(!empty($kode)){
			$paket->kode = $kode+1;
		}if(empty($kode)){
			$paket->kode = 1;
		}
		if(!empty($request->namaBarang)){
		foreach ($request->namaBarang as $key => $value) {
			if($request->namaBarang[$key] != "" && $request->jumlahBarang[$key] != ""){
				$barang_paket = new barang_paket();
				$barang = barang::findorfail($value);
				$jumlah = $request->jumlahPaket * $request->jumlahBarang[$key];
				$barang->stok -= $jumlah;
				$barang->save();
				$barang_paket->id = Uuid::uuid4()->getHex();
				$barang_paket->id_barang = $request->namaBarang[$key];
				if(!empty($kode)){
				$barang_paket->kode = $kode+1;
				}if(empty($kode)){
				$barang_paket->kode = 1;
				}
				$barang_paket->jumlah = $request->jumlahBarang[$key];
				$barang_paket->save();
			}
			else{
				Session::flash('gagal','Data barang tidak boleh kosong');
				return redirect()->back();
			}
		}
		}
		else{
			Session::flash('gagal','Data barang tidak boleh kosong');
			return redirect()->back();
		}
		$paket->save();/**
		$data = [
                //$request->input(nama_barang1."x".jumlah1.","),
				//$request->input(nama_barang2."x".jumlah2.","),
				$nama = $request->nama_barang,
				$jumlah = $request->jumlah,
            ];
		$data2 = [
                //$request->input(nama_barang1."x".jumlah1.","),
				//$request->input(nama_barang2."x".jumlah2.","),
				$request->jumlah1,
				$request->jumlah2,
            ];
		///**
			$nama1 = $request->nama_barang1;
			$nama1fix = Barang::findorfail($nama1);
			
			$nama2 = $request->nama_barang2;
			$nama2fix = Barang::findorfail($nama2);
			
			$nama2get = $nama2fix->name;
			$nama1get = $nama1fix->name;
			
			$barang1 = $nama1fix->stok - $request->jumlah1;
			$barang2 = $nama2fix->stok - $request->jumlah2;
			
		//
			if ($nama1fix->stok != 0 && $nama2fix->stok != 0 && $barang1 >= 0 && $barang2 >= 0){
				
				$nama1fix->stok -= $request->jumlah1;
				$nama1fix->save();
			
				$nama2fix->stok -= $request->jumlah2;
				$nama2fix->save();
				
				$paket = new paket();
				$paket->nama = $request->nama;
				$paket->barang = 	$nama1get." jumlah ".$request->jumlah1.", ".
									$nama2get." jumlah ".$request->jumlah2.", ".
									$barangpaket." jumlah ".$jumlahpaket;
				$paket->keterangan = $request->keterangan;
				$paket->save();
		
				Session::flash('sukses','Data peminjaman Berhasil Ditambah');
			}
			if ($barang1 < 0 && $barang2 < 0){
				Session::flash('gagal','Stok Barang '.$nama1get.' Dan '.$nama2get.' Kurang');
			}
			else if ($barang2 < 0){
				Session::flash('gagal','Stok Barang '.$nama2get.' Kurang');
			}
			else if ($barang1 < 0 ){
				Session::flash('gagal','Stok Barang '.$nama1get.' Kurang');
			}
			else if ($nama1fix->stok == 0 && $nama2fix->stok == 0){
				Session::flash('gagal','Stok Barang '.$nama1get.' Dan '.$nama2get.' Habis');
			}
			else if ($nama2fix->stok == 0){
				Session::flash('gagal','Stok Barang '.$nama2get.' Habis');
			}
			else if ($nama1fix->stok == 0 ){
				Session::flash('gagal','Stok Barang '.$nama1get.' Habis');
			}*/
		
		return redirect('paket');
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
		$kategoris = kategori::get();
		$satuans = Satuan::get();
		$Barang = Barang::get();
		return view('peminjaman.edit', compact('kem','kategoris','satuans','Barang'));
    }

    public function edit_paket($id)
    {
        $kem = paket::findorfail($id);
        $barang = Barang::join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->get(['barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name']);
        $peminjaman = barang_paket::join('barangs', 'barangs.id', '=', 'barang_pakets.id_barang')
        ->get(['barang_pakets.*', 'barangs.name as b_name', 'barangs.id as b_id']);
		return view('Paket.edit', compact('kem','peminjaman','barang'));
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
        $kem = peminjaman::findorfail($id);
        $kem->update($request->all());
		Session::flash('sukses','Data Berhasil di Edit');
        return redirect('Peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
	 
	 public function updatePaket(Request $request, $id)
    {
		foreach ($request->id_bp as $key => $value) {
			$id_bp1 = $request->id_bp[$key];
			$barang_peminjaman3 = barang_paket::findorfail($id_bp1);
			$paket = paket::findorfail($id);
			$kode1 = $barang_peminjaman3->id_barang;
			$barang0 = barang::findorfail($kode1);
			$jumlah0 = $barang_peminjaman3->jumlah * $paket->jumlah;
			$jumlah = $barang0->stok + $jumlah0;
			$upjumlah = $request->jumlahBarang1[$key] * $request->jumlahPaket;
			$barang1 = $jumlah - $upjumlah;
		}
		if ($barang1 >= 0){
			$kode = barang_paket::all()->last();
			$kem = paket::findorfail($id);
			$kem->nama = $request->nama_paket;
			$kem->keterangan = $request->keterangan;
				$barang_peminjaman0 = barang_paket::all();
				$barang_peminjaman1 = new barang_paket();
				foreach ($request->namaBarang1 as $key => $value) {
					$paket1 = paket::findorfail($id);
					$kem2 = $request->id_bp[$key];
					$barang_p1 = barang_paket::findorfail($kem2);
					$idb = $barang_p1->id_barang;
					$idb1 = $request->namaBarang1[$key];
					$barang = barang::findorfail($value);
					$jumlah000 = $barang_p1->jumlah * $paket1->jumlah;
					$jumlah11 = $barang->stok + $jumlah000;
					$barang_p5 = $request->jumlahBarang1[$key] * $request->jumlahPaket;
					$ifjumlah = $jumlah11 - $barang_p5;
					if ($ifjumlah >= 0){
						if($request->namaBarang1[$key] != $barang_p1->id_barang){
							$iftiga = $barang->stok - $barang_p5;
							if ($iftiga >= 0){
								$kem3 = paket::findorfail($id);
								$barang00 = barang::findorfail($idb);
								$barang_p2 = $barang_p1->jumlah * $kem3->jumlah;
								$barang00->stok += $barang_p2;
								$barang00->save();
								$barang_p3 = $request->jumlahBarang1[$key] * $request->jumlahPaket;
								$barang000 = barang::findorfail($idb1);
								$barang000->stok -= $barang_p3;
								$barang000->save();
							}
							else{
								Session::flash('gagal','Data barang kurang atau tidak ada');
								return redirect()->back();
							}
						}
						else{
							$jumlah00 = $barang_p1->jumlah * $paket1->jumlah;
							$jumlah1 = $barang->stok + $jumlah00;
							$barang_p4 = $request->jumlahBarang1[$key] * $request->jumlahPaket;
							$barang1 = $jumlah1 - $barang_p4;
							$barang->stok = $barang1;
							$barang->save();
						}
					}
					else{
						Session::flash('gagal','Data barang kurang atau tidak ada');
						return redirect()->back();
					}
						
				}
				
				foreach ($request->id_bp as $key => $value) {
					if($request->namaBarang1[$key] != "" && $request->jumlahBarang1[$key] != ""){
					$kem1 = $request->id_bp[$key];
					$barang_p = barang_paket::findorfail($kem1);
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
					$barang = barang::findorfail($value);
					$upjumlah1 = $request->jumlahBarang[$key] * $request->jumlahPaket;
					$data1 = $barang->stok - $upjumlah1;
					if ($data1 >= 0){
						$barang_peminjaman = new barang_paket();
						$barang_peminjaman4 = barang_paket::all();
						$kem1 = paket::findorfail($id);
						$bkem = $kem1->kode;
						$barang_p6 = $request->jumlahBarang[$key] * $request->jumlahPaket;
						$barang->stok -= $barang_p6;
						$barang->save();
						$barang_peminjaman->id = Uuid::uuid4()->getHex();
						$barang_peminjaman->id_barang = $request->namaBarang[$key];
						$barang_peminjaman->kode = $request->kode_bp;
						$barang_peminjaman->jumlah = $request->jumlahBarang[$key];
						$barang_peminjaman->save();
					}
					else{
						Session::flash('gagal','Data barang kurang atau tidak ada');
						return redirect()->back();
					}
				}
			}
			Session::flash('sukses','Data Berhasil di Edit');
		}
		else{
			Session::flash('gagal','Data barang kurang atau tidak ada');
			return redirect()->back();
		}
		
			$kem->jumlah = $request->jumlahPaket;
			$kem->update();
        return redirect('paket');
    }
	
	
	 public function destroypaketbarang(Request $request,$id)
    {
		$del = barang_paket::findorfail($id);
		$barang1 = barang::all();
		foreach ($barang1 as $key => $value) {
			$kode = $del->id_barang;
			$kode1 = $del->kode;
			$del1 = paket::where('kode', $kode1)->first();
			if($value->id == $kode){
				$data = $del->jumlah * $del1->jumlah;
				$value->stok += $data;
				$value->save();
			}
		}
		$del->delete();
		return redirect()->back();
    }
	 
    public function destroy($id)
    {
		$del = paket::findorfail($id);
		$kode = $del->kode;
		$barang_paket = barang_paket::all();
        foreach ($barang_paket as $key => $value) {
				if($value->kode == $kode){
					$id_barang = $value->id_barang;
					$barang = Barang::findorfail($id_barang);
					$jumlah = $del->jumlah * $value->jumlah;
					$barang->stok += $jumlah;
					$barang->save();
				}
		}
		foreach ($barang_paket as $key => $value) {
			if($value->kode == $kode){
				$value->delete();
			}
		}
		$del->delete();
		Session::flash('sukses','Data Paket Berhasil Dihapus');
		return redirect('paket');
    }
}
