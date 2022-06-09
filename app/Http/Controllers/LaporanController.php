<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Http\Controllers\Controller;
use App\Imports\BarangImport;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function add_import()
    {
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        return view('barang.import', compact('kategoris','satuans'));
    }
    public function store_import(Request $request)
    {
        $this->validate($request, [
            'kategori_id'   => 'required',
            'satuan_id'     => 'required',
            'file'          => 'required|mimes:csv,xlx,xls,xlsx|max:2048kb',
            ],[
                'kategori_id.required'  =>'Kategori Barang tidak boleh kosong',
                'satuan_id.required'    =>'Satuan Barang tidak boleh kosong',
                'file.required'         =>'Gambar Barang tidak boleh kosong',
                'file.mimes'            =>'Format gambar harus csv/xlx/xls/xlsx',
                'file.max'              =>'Ukuran Max Foto Barang 2 Mb',
    
            ]);
        $data = new Barang();
        $data->id = Uuid::uuid4()->getHex();
        $data->kategori_id = $request->kategori_id;
        $data->satuan_id = $request->satuan_id;
        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('reports', $fileName, 'public');

        $data->file = $filePath;

        if ($data->save()) {
            Excel::import(new BarangImport($data), $request->file('file'));
        }

        return redirect()->route('index_barang')->with('success','Data have been imported');
    }
   /*  public function export_excel(Request $request)
	{
		$nama_file = 'laporan_barang_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new BarangExport, $nama_file);
	} */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
