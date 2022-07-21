<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class BarangMasukController extends Controller
{
    public function __construct()
    {
        $this->Barang = new BarangMasuk();
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas  = Suppliers::has('barangmasuk')
            ->with('barangmasuk','barangmasuk.barang')
            ->withCount('barangmasuk')
            ->paginate(5);
        return view('barangmasuk.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $suppliers = Suppliers::all();
        return view('barangmasuk.add', compact('barang','suppliers'));
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
            'tggl_masuk'    => 'required',
            'stok'     => 'required|min:0',
            'barang_id'     => 'required',
            'suppliers_id'  => 'required',
        ],[
            'tggl_masuk.required'   =>'Tanggal Masuk tidak boleh kosong',
            'stok.required'    =>'stok tidak boleh kosong',
            'stok.min'         =>'stok minimal 0',
            'barang_id.required'    =>'Nama Barang tidak boleh kosong',
            'suppliers_id.required' =>'Nama Suppliers tidak boleh kosong',
        ]);
        $data = new BarangMasuk;
        $data->id               = Uuid::uuid4()->getHex();
        $data->tggl_masuk       = $request->tggl_masuk;
        $data->stok        = $request->stok;   
        $data->barang_id        = $request->barang_id;
        $data->suppliers_id     = $request->suppliers_id;        
        $data->save();

        $barang = Barang::findOrFail($request->barang_id);
        $barang->stok += $request->stok;
        $barang->save();
        return redirect()->route('index_barang_masuk')->with('pesan','Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barangmasuk = BarangMasuk::find($id);
        $suppliers = Suppliers::all();
        return view('barangmasuk.edit', compact('barangmasuk','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Request()->validate([
            'tggl_masuk'    => 'required',
            'stok'     => 'required|min:0',
            'suppliers_id'  => 'required',
        ],[
            'tggl_masuk.required'   =>'Tanggal Masuk tidak boleh kosong',
            'stok.required'    =>'stok tidak boleh kosong',
            'stok.min'         =>'stok minimal 0',
            'suppliers_id.required' =>'Nama Suppliers tidak boleh kosong',
        ]);
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk->tggl_masuk    = $request->tggl_masuk;
        $barangmasuk->stok          = $request->stok;
        $barangmasuk->suppliers_id  = $request->suppliers_id;        
        $barangmasuk->save();
        
        $barang = Barang::findOrFail($barangmasuk->barang_id);
        $barang->stok += $request->stok;
        $barang->save();
        return redirect()->route('index_barang_masuk')->with('pesan','Data Berhasil Disimpan');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($barang_id)
    {
        try {
            $barangmasuk = BarangMasuk::find($barang_id);
            $barangmasuk->delete();                           
        return redirect()->route('index_barang_masuk')->with('delete', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index_barang_masuk')->withErrors('Data gagal Dihapus');
        }
    }
}
