<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use DB;
use Session;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = peminjaman::get();
        return view('Peminjaman.index', compact('data'));
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
		return view('peminjaman.add', compact('kategoris','satuans','Barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
