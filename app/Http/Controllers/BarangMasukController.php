<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function __construct()
    {
        $this->BarangMasuk = new BarangMasuk();
        $this->Barang = new Barang();
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $BarangMasuk = BarangMasuk::all();
        return view('BarangMasuk.index', compact('BarangMasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        return view('BarangMasuk.add', compact('kategoris','satuans'));
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
            'id'            => 'required|unique:barangs,id|max:255',
            'name'          => 'required',
            'nama_konsumen' => 'required',
            'stok'          => 'required|min:0',
            'kategori_id'   => 'required',
            'satuan_id'     => 'required',
            'tggl_masuk'    => 'required',
            'file'          => 'required|mimes:jpeg,jpg,png|max:2048kb',
            ],[
                'id.required'           =>'Kode Barang tidak boleh kosong',
                'id.unique'             =>'Kode Barang sudah terpakai',
                'id.max'                =>'Kode Barang max 255 karakter',
                'name.required'         =>'Nama Barang tidak boleh kosong',
                'nama_konsumen.required'=>'Nama Konsumen tidak boleh kosong',
                'stok.required'         =>'stok tidak boleh kosong',
                'stok.min'              =>'stok minimal 0',
                'kategori_id.required'  =>'Kategori Barang tidak boleh kosong',
                'satuan_id.required'    =>'Satuan Barang tidak boleh kosong',
                'tggl_masuk.required'   =>'Tanggal Masuk tidak boleh kosong',
                'file.required'         =>'Gambar Barang tidak boleh kosong',
                'file.mimes'            =>'Format gambar harus jpeg/jpg/png',
                'file.max'              =>'Ukuran Max Foto Barang 2 Mb',
    
            ]);//upload gambar
        $file = $request->file('file');
        $fileName = Request ()->id .'.'. $file->extension();
        $file->move('img/barang/',$fileName);
        
        $data = $request->all();
        $Barang = new Barang;
        $Barang->id             = $data['id'];
        $Barang->name           = $data['name'];
        $Barang->stok           = $data['stok'];
        $Barang->kategori_id    = $data['kategori_id'];
        $Barang->satuan_id      = $data['satuan_id'];
        $Barang->file           = $fileName;
        
        $BarangMasuk = new BarangMasuk;
        $BarangMasuk->barang_id         = $Barang->id; 
        $BarangMasuk->id_barang_masuk   = $Barang->id;
        $BarangMasuk->tggl_masuk        = $data['tggl_masuk'];
        $BarangMasuk->stok_awal         = $Barang->stok;
        $BarangMasuk->nama_konsumen     = $data['nama_konsumen'];
        $Barang->save();
        $BarangMasuk->save();
        return redirect()->route('index_barang_masuk')->with('pesan','Data Berhasil Disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $BarangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BarangMasuk $BarangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $BarangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangMasuk $BarangMasuk, $id)
    {
        $BarangMasuk    = BarangMasuk::findOrFail($id);
        $Barang         = Barang::findOrFail($id);
        $kategoris      = Kategori::all();
        $satuans        = Satuan::all();
        return view('BarangMasuk.edit',compact('BarangMasuk','kategoris','satuans','Barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $BarangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangMasuk $BarangMasuk, Barang $Barang, $id)
    {
        Request()->validate([
            'id'            => 'required|unique:barangs,id|max:255',
            'name'          => 'required',
            'nama_konsumen' => 'required',
            'stok'          => 'required|min:0',
            'kategori_id'   => 'required',
            'satuan_id'     => 'required',
            'tggl_masuk'    => 'required',
            'file'          => 'required|mimes:jpeg,jpg,png|max:2048kb',
        ],[
                'id.required'           =>'Kode Barang tidak boleh kosong',
                'id.unique'             =>'Kode Barang sudah terpakai',
                'id.max'                =>'Kode Barang max 255 karakter',
                'name.required'         =>'Nama Barang tidak boleh kosong',
                'nama_konsumen.required'=>'Nama Konsumen tidak boleh kosong',
                'stok.required'         =>'stok tidak boleh kosong',
                'stok.min'              =>'stok minimal 0',
                'kategori_id.required'  =>'Kategori Barang tidak boleh kosong',
                'satuan_id.required'    =>'Satuan Barang tidak boleh kosong',
                'tggl_masuk.required'   =>'Tanggal Masuk tidak boleh kosong',
                'file.required'         =>'Gambar Barang tidak boleh kosong',
                'file.mimes'            =>'Format gambar harus jpeg/jpg/png',
                'file.max'              =>'Ukuran Max Foto Barang 2 Mb',
    
        ]);
        $data = $request->all();
        $Barang = new Barang;
        $Barang->id             = $data['id'];
        $Barang->name           = $data['name'];
        $Barang->stok           = $data['stok'];
        $Barang->kategori_id    = $data['kategori_id'];
        $Barang->satuan_id      = $data['satuan_id'];
        if (empty($request->file('file')))
        {
            $Barang->file = $Barang->file;
        }
        else{
            
            $destinationPath = 'img/barang/'.$Barang->file;
            Barang::destroy($destinationPath.'img/barang'.$Barang->file);
            $file = $request->file('file');
            $fileName = Request ()->id .'.'. $file->extension();
            $file->move('img/barang/',$fileName);
            $Barang->file = $fileName;
        }

        $BarangMasuk = new BarangMasuk;
        $BarangMasuk->barang_id         = $Barang->id; 
        $BarangMasuk->id_barang_masuk   = $Barang->id;
        $BarangMasuk->tggl_masuk        = $data['tggl_masuk'];
        $BarangMasuk->stok_awal         = $Barang->stok;
        $BarangMasuk->nama_konsumen     = $data['nama_konsumen'];
        $Barang->update();
        $BarangMasuk->update();
        return redirect()->route('index_barang_masuk')->with('pesan','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $BarangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangMasuk $BarangMasuk, $id)
    {
        try {
            $BarangMasuk = BarangMasuk::find($id);
            $BarangMasuk->delete();
            return redirect()->route('index_barang_masuk')->with('delete', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index_barang_masuk')->withErrors('Data gagal Dihapus');
        }
    }
}
