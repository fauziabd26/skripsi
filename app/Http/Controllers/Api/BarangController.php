<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::all();
        return response()->json(['Data Barang : ', BarangResource::collection($data) ], Response::HTTP_OK);
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
        if($validator->fails()){
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try
        {
            $file      = $request->file('file');
            $imageName  = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('img/barang/'), $imageName);

            $data = new Barang();
            $data->id = Uuid::uuid4()->getHex();
            $data->name = $request->name;
            $data->stok = $request->stok;
            $data->kategori_id = $request->kategori_id;
            $data->satuan_id = $request->satuan_id;
            $data->file = $imageName;
            $data->created_at = date('Y-m-d H:i:s');
            $data->updated_at = date('Y-m-d H:i:s');
            $data->save();
            $response = [
                'success' => true,
                'message' => 'Barang Created',
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
        $barang = Barang::find($id);
        if (is_null($barang)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json(['Detail Barang : ', new BarangResource($barang)]);
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
        $barang = Barang::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name'          => 'required',
            'stok'          => 'required|min:0',
            'kategori_id'   => 'required',
            'satuan_id'     => 'required',
            'file'          => 'mimes:jpeg,jpg,png|max:2048kb',
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
        if($validator->fails()){
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try
        {
            if($request->file('file')){
                $fileName = time().$request->file('file')->getClientOriginalName();
                $path = $request->file('file')->storeAs('img/barang/',$fileName);
            }

            $barang->update([
            'name' => $request->name,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'satuan_id' => $request->satuan_id,
            'file' => $path,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
            ]);
            return response()->json(['Barang updated successfully.', new BarangResource($barang)],Response::HTTP_OK);
        }
        catch(QueryException $e)
        {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        try {
            $barang->delete();
            $response =[
                'message' => 'Barang Deleted'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
