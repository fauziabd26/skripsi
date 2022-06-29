<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SatuanResource;
use App\Models\Satuan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Satuan::all();
        return response()->json(['Data Satuan.', SatuanResource::collection($data) ], Response::HTTP_OK);
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
            'name'          => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try
        {
            $satuan = Satuan::create([
                'id'    => Uuid::uuid4()->getHex(),
                'name'  => $request->name
            ]);
            $response = [
                'message' => 'Satuan Created',
                'data' => $satuan
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
        $satuan = Satuan::find($id);
        if (is_null($satuan)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json(['Detail Satuan.', new SatuanResource($satuan)]);

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
    public function update(Request $request, $id, Satuan $satuan)
    {
        $satuan = Satuan::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);       
        }

        try
        {
            $satuan->update([
                'name'  => $request->name
            ]);
            return response()->json(['Satuan updated successfully.', new SatuanResource($satuan)],Response::HTTP_OK);
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
        $satuan = Satuan::findOrFail($id);
        try {
            $satuan->delete();
            $response =[
                'message' => 'Satuan Deleted'
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
