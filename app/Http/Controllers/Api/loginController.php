<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class loginController extends Controller
{

    public function registerAdmin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|max:255',            
            'password'  => 'required|min:8|max:255'
            ],[
                'name.required'     =>'Nama tidak boleh kosong',
                'name.max'          =>'Nama max 255 karakter',
                'password.required' =>'Password tidak boleh kosong',
                'password.max'      =>'Password max 255 karakter',
                'password.min'      =>'Password min 8 karakter',
            ]);    
            
            if($validator->fails()){
                return response()->json($validator->errors());       
            }
            try{
                $user = User::create([
                    'id'       => Uuid::uuid4()->getHex(),
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'role_id' => 1,
                 ]);
                 $token = $user->createToken('auth_token')->plainTextToken;
                 $response =[
                    'status' => true,                   
                    'message' => 'User Admin Created',
                    'data' => $user,
                    'access_token' => $token, 
                    'token_type' => 'Bearer'
                 ];
            return response()->json($response, Response::HTTP_CREATED);
            }
            catch(QueryException $e){
                return response()->json([
                    'status' => false,

                    'message' => "Failed" . $e->errorInfo
                ],502);
            }
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('name', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('name', $request['name'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function logout(Request $request) {
        if ($request->user()) { 
            $request->user()->tokens()->delete();
        }
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
        ];
        return response()->json($respon, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
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
        //
    }
}
