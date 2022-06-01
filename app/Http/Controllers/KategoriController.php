<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->Kategori = new Kategori();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.add');

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
            'id'            => 'required|unique:kategoris,id|max:255',
            'name'          => 'required',
            ],[
                'id.required'       =>'id tidak boleh kosong',
                'id.unique'         =>'id sudah terpakai',
                'id.max'            =>'id max 255 karakter',
                'name.required'     =>'Nama Kategori tidak boleh kosong',
            ]);
            $datas = [
                'id'            => Request()->id,
                'name'          => Request()->name,
            ];
            $this->Kategori->addData($datas);
            return redirect()->route('index_kategori')->with('pesan','Data Berhasil Disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit',compact('kategori'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        $kategori->name = $request->name;
        $kategori->save();
        return redirect('/kategori')->with('pesan', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $kategori = Kategori::find($id);
            $kategori->delete();
            return redirect('/kategori')->with('delete', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect('/kategori')->withErrors('Data gagal Dihapus');
        }

    }
}
