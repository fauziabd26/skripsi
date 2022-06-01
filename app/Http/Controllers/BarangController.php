<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('admin');
        $this->Barang = new Barang();
    }

    public function index()
    {
       $datas = [
           'barang'=> $this->Barang->allData(),
       ];
       return view('barang.index', $datas);
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
        return view('barang.add', compact('kategoris','satuans'));
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
        'stok'          => 'required|min:0',
        'kategori_id'   => 'required',
        'satuan_id'     => 'required',
        'file'          => 'required|mimes:jpeg,jpg,png|max:2048kb',
        ],[
            'id.required'           =>'Kode Barang tidak boleh kosong',
            'id.unique'             =>'Kode Barang sudah terpakai',
            'id.max'                =>'Kode Barang max 255 karakter',
            'name.required'         =>'Nama Barang tidak boleh kosong',
            'stok.required'         =>'stok tidak boleh kosong',
            'stok.min'              =>'stok minimal 0',
            'kategori_id.required'  =>'Kategori Barang tidak boleh kosong',
            'satuan_id.required'    =>'Satuan Barang tidak boleh kosong',
            'file.required'         =>'Gambar Barang tidak boleh kosong',
            'file.mimes'            =>'Format gambar harus jpeg/jpg/png',
            'file.max'              =>'Ukuran Max Foto Barang 2 Mb',

        ]);
        //upload gambar
        $file = $request->file('file');
        $fileName = Request ()->id .'.'. $file->extension();
        $file->move('img/barang/',$fileName);
        
        $datas = [
            'id'            => Request()->id,
            'name'          => Request()->name,
            'stok'          => Request()->stok,
            'kategori_id'   => Request()->kategori_id,
            'satuan_id'     => Request()->satuan_id,
            'file'          => $fileName,
        ];
        $this->Barang->addData($datas);
        return redirect()->route('index_barang')->with('pesan','Data Berhasil Disimpan');

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
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        return view('barang.edit',compact('barang','kategoris','satuans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang, $id)
    {
        Request()->validate([
            'id'            => 'required|max:255',
            'name'          => 'required',
            'stok'          => 'required',
            'kategori_id'   => 'required',
            'satuan_id'     => 'required',
            'file'          => 'mimes:jpeg,jpg,png|max:2048kb',
        ],[
                'id.required'       =>'id tidak boleh kosong',
                'id.max'            =>'id max 255 karakter',
                'name.required'     =>'Nama Barang tidak boleh kosong',
                'stok.required'     =>'stok tidak boleh kosong',
                'kategori_id.required' =>'Kategori Barang tidak boleh kosong',
                'satuan_id.required'   =>'Satuan Barang tidak boleh kosong',
                'file.mimes'        =>'Format gambar harus jpeg/jpg/png',
                'file.max'          =>'Ukuran Max Foto Barang 2 Mb',
    
        ]);
        $datas = [
                'id'            => Request()->id,
                'name'          => Request()->name,
                'stok'          => Request()->stok,
                'kategori_id'   => Request()->kategori_id,
                'satuan_id'     => Request()->satuan_id,
        ];
        if (empty($request->file('file')))
        {
                $barang->file = $barang->file;
        }
        else{
            
                $destinationPath = 'img/barang/'.$barang->file;
                Barang::destroy($destinationPath.'img/barang'.$barang->file);
                $file = $request->file('file');
                $fileName = Request ()->id .'.'. $file->extension();
                $file->move('img/barang/',$fileName);
                $barang->file = $fileName;
        }
        $this->Barang->editData($id, $datas);
        return redirect()->route('index_barang')->with('pesan','Data Berhasil Diupdate');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang, $id)
    {
        try {
            $barang = Barang::find($id);
            $barang->delete();
            return redirect('/barang')->with('delete', 'Data Berhasil Dihapus');
        }catch (\Throwable $th) {
            return redirect('/barang')->withErrors('Data gagal Dihapus');
        }
    }
}