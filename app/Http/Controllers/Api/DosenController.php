<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DosenResource;
use App\Models\Dosen;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Dosen::all();
        return response()->json(['Data Dosen : ', DosenResource::collection($data) ], Response::HTTP_OK);
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
            'nip'                   => 'required|unique:dosens,nip|max:255',
            'name'                  => 'required',
            'keterangan'            => 'required',
        ],[
            'nip.required'          =>'Nip Dosen tidak boleh kosong',
            'nip.unique'            =>'Nip Dosen sudah terpakai',
            'nip.max'               =>'Nip Dosen max 255 karakter',
            'name.required'         =>'Nama Dosen tidak boleh kosong',
            'keterangan.required'   =>'Keterangan Dosen tidak boleh kosong',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try
        {
            $dosen = Dosen::create([
                'id'            => Uuid::uuid4()->getHex(),
                'nip'           => $request->nip,
                'name'          => $request->name,
                'keterangan'    => $request->keterangan
            ]);
            $response = [
                'message'   => 'Dosen Created',
                'data'      => $dosen
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
        $dosen = Dosen::find($id);
        if (is_null($dosen)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json(['Detail Dosen : ', new DosenResource($dosen)]);
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
        $dosen = Dosen::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'nip'                   => 'required',
            'name'                  => 'required',
            'keterangan'            => 'required',
        ],[
            'nip.required'                          =>'Nip Dosen tidak boleh kosong',
            'name.required'                         =>'Nama Dosen tidak boleh kosong',
            'keterangan.required'                   =>'Keterangan Dosen tidak boleh kosong',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);       
        }

        try
        {
            $dosen->update([
                'name'        => $request->name,
                'nip '        => $request->nip,
                'name'        => $request->name,
                'keterangan'  => $request->keterangan
            ]);
            return response()->json(['Dosen updated successfully.', new DosenResource($dosen)],Response::HTTP_OK);
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
        $dosen = Dosen::findOrFail($id);
        try {
            $dosen->delete();
            $response =[
                'message' => 'Dosen Deleted'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
