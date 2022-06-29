<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mahasiswa::all();
        return response()->json(['Data Mahasiswa : ', MahasiswaResource::collection($data) ], Response::HTTP_OK);
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
            'nim'                   => 'required|unique:mahasiswas,nim',
            'name'                  => 'required',
            'kelas'                 => 'required',
        ],[
            'nim.required'                          =>'Nim Mahasiswa tidak boleh kosong',
            'nim.unique'                            =>'Nim Mahasiswa sudah ada',
            'name.required'                         =>'Nama Mahasiswa tidak boleh kosong',
            'kelas.required'                        =>'Kelas Mahasiswa tidak boleh kosong',        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try
        {
            $mahasiswa = Mahasiswa::create([
                'id'    => Uuid::uuid4()->getHex(),
                'nim'   => $request->nim,
                'name'  => $request->name,
                'kelas' => $request->kelas
            ]);
            $response = [
                'message'   => 'Mahasiswa Created',
                'data'      => $mahasiswa
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
        $mahasiswa = Mahasiswa::find($id);
        if (is_null($mahasiswa)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json(['Detail Mahasiswa : ', new MahasiswaResource($mahasiswa)]);
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
        $mahasiswa = Mahasiswa::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'nim'   => 'required',
            'name'  => 'required',
            'kelas' => 'required',
        ],[
            'nim.required'  =>'Nim Mahasiswa tidak boleh kosong',
            'name.required' =>'Nama Mahasiswa tidak boleh kosong',
            'kelas.required'=>'kelas Mahasiswa tidak boleh kosong',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);       
        }

        try
        {
            $mahasiswa->update([
                'nim '  => $request->nim,
                'name'  => $request->name,
                'kelas' => $request->kelas
            ]);
            return response()->json(['Mahasiswa updated successfully.', new MahasiswaResource($mahasiswa)],Response::HTTP_OK);
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
        $mahasiswa = Mahasiswa::findOrFail($id);
        try {
            $mahasiswa->delete();
            $response =[
                'message' => 'Mahasiswa Deleted'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
