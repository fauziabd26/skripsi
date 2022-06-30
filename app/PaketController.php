<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\peminjaman;
use App\Models\paket;
use Illuminate\Http\Request;
use DB;
use Session;

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
        return view('Paket.index', compact('data'));
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
		$data = [
                //$request->input(nama_barang1."x".jumlah1.","),
				//$request->input(nama_barang2."x".jumlah2.","),
				$request->nama_barang1,
				$request->nama_barang2,
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
			$nama1fix->stok -= $request->jumlah1;
			$nama1fix->save();
			
			$nama2 = $request->nama_barang2;
			$nama2fix = Barang::findorfail($nama2);
			$nama2fix->stok -= $request->jumlah2;
			$nama2fix->save();
			
			$nama1get = $nama1fix->name;
			$nama2get = $nama2fix->name;
		//*/
				$paket = new paket();
				$paket->nama = $request->nama;
				$paket->barang = 	$nama1get." jumlah ".$request->jumlah1.", ".
									$nama2get." jumlah ".$request->jumlah2;
				$paket->keterangan = $request->keterangan;
				$paket->save();
		
		Session::flash('sukses','Data peminjaman Berhasil Ditambah');
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
    public function destroy($id)
    {
        $del = peminjaman::findorfail($id);
		$del->delete();
		return redirect('Peminjaman');
    }
}
