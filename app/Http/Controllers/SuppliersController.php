<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::all();
        return view('suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Suppliers::all();
        return view('suppliers.add',compact('suppliers'));
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
            'name'      => 'required',
            'alamat'    => 'required',
            'email'     => 'required|email',
            'telepon'   => 'required',
            ],[
                'name.required'     =>'Nama Supplier tidak boleh kosong',
                'alamat.required'   =>'Alamat Supplier tidak boleh kosong',
                'telepon.required'  =>'Nomor Telpon Supplier tidak boleh kosong',
                'email.required'    =>'Email Wajib Diisi',
                'email.email'       =>'Penulisan Harus Menggunakan Format Email',
            ]);
            
            $data = new Suppliers();
            $data->id = Uuid::uuid4()->getHex();
            $data->name = $request->name;
            $data->alamat = $request->alamat;
            $data->email = $request->email;
            $data->telepon = $request->telepon;
            $data->save();
            return redirect()->route('index_suppliers')->with('pesan','Data Berhasil Disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers = Suppliers::findOrFail($id);
        return view('suppliers.edit',compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suppliers $suppliers)
    {
        $suppliers = Suppliers::find($request->id);
        $suppliers->name    = $request->name;
        $suppliers->alamat  = $request->alamat;
        $suppliers->email   = $request->email;
        $suppliers->telepon = $request->telepon;
        $suppliers->save();
        return redirect()->route('index_suppliers')->with('pesan', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppliers $suppliers, $id)
    {
        try {
            $suppliers = Suppliers::find($id);
            $suppliers->delete();
            return redirect()->route('index_suppliers')->with('delete', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index_suppliers')->withErrors('Data gagal Dihapus');
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $suppliers = Suppliers::where('name', 'like', "%" . $keyword . "%")->paginate(5);
        return view('suppliers.index', compact('suppliers'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
