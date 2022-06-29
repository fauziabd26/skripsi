<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BarangMasukResource;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BarangMasuk::all();
        return response()->json(['Data Barang Masuk : ', BarangMasukResource::collection($data) ], Response::HTTP_OK);
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
        $validator = Validator::make($request->all(),[
            'file'          => 'required|mimes:jpeg,jpg,png|max:2048kb',
        ],[
            'file.mimes'            =>'Format gambar harus jpeg/jpg/png',
            'file.max'              =>'Ukuran Max Foto Barang 2 Mb',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try
        {
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
            $response = [
                'success' => true,
                'message' => 'Barang Masuk Created',
                'data' => $data
            ];
            return response()->json($response, Response::HTTP_CREATED);
        }
        catch(QueryException $e)
        {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
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
        $barangmasuk = BarangMasuk::findOrFail($id);
        try {
            $barangmasuk->delete();
            $response =[
                'message' => 'Barang Masuk Deleted'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
