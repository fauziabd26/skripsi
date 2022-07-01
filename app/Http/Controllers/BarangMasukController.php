<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\Satuan;
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
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        $datas = BarangMasuk::with('barang','kategori','satuan')->paginate(5);
        $barang = Barang::with('kategori','satuan')->paginate(5);
        return view('barangmasuk.index', compact('datas','satuans','kategoris','barang'));
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
        return view('barangmasuk.add', compact('kategoris','satuans'));
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
            'name'          => 'required',
            'nama_konsumen' => 'required',
            'stok'          => 'required|min:0',
            'kategori_id'   => 'required',
            'satuan_id'     => 'required',
            'tggl_masuk'    => 'required',
            'file'          => 'mimes:jpeg,jpg,png|max:2048kb',
        ],[
            'name.required'         =>'Nama Barang tidak boleh kosong',
            'nama_konsumen.required'=>'Nama Konsumen tidak boleh kosong',
            'stok.required'         =>'stok tidak boleh kosong',
            'stok.min'              =>'stok minimal 0',
            'kategori_id.required'  =>'Kategori Barang tidak boleh kosong',
            'satuan_id.required'    =>'Satuan Barang tidak boleh kosong',
            'tggl_masuk.required'   =>'Tanggal Masuk tidak boleh kosong',
            'file.mimes'            =>'Format gambar harus jpeg/jpg/png',
            'file.max'              =>'Ukuran Max Foto Barang 2 Mb'
        ]);
        //upload gambar
        $file      = $request->file('file');
        $imageName  = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('img/barang/'), $imageName);
        
        $barang = new Barang;
        $barang->id             = Uuid::uuid4()->getHex();
        $barang->name           = $request->name;
        $barang->stok           = $request->stok;
        $barang->kategori_id    = $request->kategori_id;
        $barang->satuan_id      = $request->satuan_id;
        $barang->file           = $imageName;
        
        $data = new BarangMasuk;
        $data->id               = Uuid::uuid4()->getHex();
        $data->tggl_masuk       = $request->tggl_masuk;
        $data->stok_awal        = $barang->stok;
        $data->nama_konsumen    = $request->nama_konsumen;
        $data->barang_id        = $barang->id;        
        $barang->save();
        $data->save();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data =DB::table('barangs')
                    ->join('barang_masuks','barang_masuks.id', '=','barangs.id')
                    ->where('barangs.id', $id); 
            DB::table('barang_masuks')->where('barang_id', $id)->delete();                           
                $data->delete();    
        return redirect()->route('index_barang_masuk')->with('delete', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index_barang_masuk')->withErrors('Data gagal Dihapus');
        }
    }
}
