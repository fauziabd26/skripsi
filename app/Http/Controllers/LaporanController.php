<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Excel;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = DB::table('barangs')
        ->join('kategoris', 'kategoris.id', '=', 'barangs.kategori_id')
        ->join('satuans', 'satuans.id', '=', 'barangs.satuan_id')
        ->select('barangs.*', 'kategoris.name as k_name', 'satuans.name as s_name')
        ->get();
        return view('laporan.index', compact('barang'));
    }
    
    public function export_excel(Request $request)
	{
		$request->validate([
            'month'     => 'required',
            'year'      => 'required',
            'extension' => 'required|in:csv,xlsx'
        ]);
        
        $barang = Barang::with(['barangs'])
                        ->whereYear('created_at', $request->year)
                        ->whereMonth('created_at', $request->month)
                        ->get();

        if ($barang) {
            $name_file = 'Laporan Barang.'.$request->extension;
        
            return (new BarangExport($request->year, $request->month))->download($name_file);
        }
        
        return back()->with('error', 'Maaf data kosong');
	}

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
