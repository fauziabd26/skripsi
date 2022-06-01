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
use Session;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pengembalian::get();
		$data1 = kondisi::get();
        return view('Pengembalian.index', compact('data','data1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = kondisi::get();
		return view('Pengembalian.add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		 pengembalian::create([
			'nama_barang' => $request->nama_barang,
			'nama_peminjam' => $request->nama_peminjam,
			'jumlah_pengembalian' => $request->jumlah_pengembalian,
			'tanggal_peminjaman' => $request->tanggal_peminjaman,
			'waktu_peminjaman' => $request->waktu_peminjaman,
			'tanggal_pengembalian' => $request->tanggal_pengembalian,
			'kondisi' => $request->kondisi,
			
		]);
		Session::flash('sukses','Data Pengembalian Berhasil Ditambah');
		return redirect('Pengembalian');
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
		$kem = pengembalian::findorfail($id);
        $kem->update($request->all());
		Session::flash('sukses','Data Berhasil di Edit');
        return redirect('Pengembalian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = pengembalian::findorfail($id);
		$del->delete();
		return redirect('Pengembalian');
    }
}
