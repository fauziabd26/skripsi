<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Imports\BarangImport;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->Barang = new Barang();
        $this->middleware('auth');
    }

    public function index()
    {
        //
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
        'name'          => 'required',
        'stok'          => 'required|min:0',
        'kategori_id'   => 'required',
        'satuan_id'     => 'required',
        'file'          => 'required|mimes:jpeg,jpg,png|max:2048kb',
        ],[
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
        $file      = $request->file('file');
        $imageName  = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('img/barang/'), $imageName);

        
        $data = new Barang();
        $data->id           = Uuid::uuid4()->getHex();
        $data->name         = $request->name;
        $data->stok         = $request->stok;
        $data->kategori_id  = $request->kategori_id;
        $data->satuan_id    = $request->satuan_id;
        $data->file         = $imageName;
        $data->created_at = date('Y-m-d H:i:s');
        $data->updated_at = date('Y-m-d H:i:s');
        $data->save();

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
        $barang = Barang::with('kategori','satuan')->findOrFail($id);
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
            'name'          => 'required',
            'stok'          => 'required',
            'kategori_id'   => 'required',
            'satuan_id'     => 'required',
            'file'          => 'mimes:jpeg,jpg,png|max:2048kb',
        ],[
            'name.required'     =>'Nama Barang tidak boleh kosong',
            'stok.required'     =>'stok tidak boleh kosong',
            'kategori_id.required' =>'Kategori Barang tidak boleh kosong',
            'satuan_id.required'   =>'Satuan Barang tidak boleh kosong',
            'file.mimes'        =>'Format gambar harus jpeg/jpg/png',
            'file.max'          =>'Ukuran Max Foto Barang 2 Mb',
            
        ]);
        $barang = Barang::findOrFail($id);
        $barang->name = $request->name;
        $barang->stok = $request->stok;
        $barang->kategori_id = $request->kategori_id;
        $barang->satuan_id = $request->satuan_id;
        
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
        $barang->update();
        return redirect()->route('index_barang')->with('pesan','Data Berhasil Diupdate');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $barang = Barang::find($id);
            $barang->delete();
            return redirect()->route('index_barang')->with('delete', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index_barang')->withErrors('Data gagal Dihapus');
        }
    }
    
    public function indexBarang()
    {
        $barang = Barang::with('kategori','satuan')->get();
        return view('laporan.index', compact('barang'));
    }
    public function cetakpertanggal(Request $request)
    {        
        $tglawal=$request->tglawal;
        $tglakhir=$request->tglakhir;
        $barang = Barang::whereBetween('created_at',[$request->tglawal, $request->tglakhir])
        ->latest()
        ->get();
        
        return view('barang.cetakpdf', compact('barang','tglawal','tglakhir'));            
        
    }
    public function export(Request $request) 
    {
        $tglawal=$request->tglawal;
        $tglakhir=$request->tglakhir;
        $barang = Barang::whereBetween('created_at',[$request->tglawal, $request->tglakhir])
        ->latest()
        ->get();
    
        return Excel::download(new BarangExport($tglawal, $tglakhir), 'Laporan Barang.xlsx');
    }
    public function import(Request $request) 
    {
        $kategoris = Kategori::findOrFail($request->kategori_id);
        
        Excel::import(new BarangImport($kategoris), $request->file('file'));
        return redirect()->route('index_barang')->with('Data Success di Import'); 
    }
    public function search(Request $request)
    {
        $keyword = $request->search;
        $kategoris = Kategori::all();
        $barang = Barang::where('name', 'like', "%" . $keyword . "%")->paginate(5);
        return view('barang.index', compact('barang','kategoris'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function trash()
    {
    	$barang = Barang::onlyTrashed()->get();
    	return view('barang.trash', ['barang' => $barang]); 
    }
    public function kembalikan($id)
    {
    	$barang = Barang::onlyTrashed()->where('id',$id);
    	$barang->restore();
    	return redirect()->route('index_recycle_bin')->with('success', 'Data Berhasil Dikembalikan');
    }
    public function kembalikan_semua()
    {
    		
    	$barang = Barang::onlyTrashed();
    	$barang->restore();
 
    	return redirect()->route('index_recycle_bin')->with('success', 'Data Berhasil Dikembalikan');
    }
    public function hapus_permanen($id)
    {

    	$barang = Barang::onlyTrashed()->where('id',$id);
    	$barang->forceDelete();
 
    	return redirect()->route('index_recycle_bin')->with('success', 'Data Berhasil Dihapus');
    }
    public function hapus_permanen_semua()
    {
    	$barang = Barang::onlyTrashed();
    	$barang->forceDelete();
 
    	return redirect()->route('index_recycle_bin')->with('success', 'Data Berhasil Dihapus');
    }
}