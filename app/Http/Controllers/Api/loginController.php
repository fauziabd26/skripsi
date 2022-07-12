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
                 $response =[
                    'status' => true,                   
                    'message' => 'User Admin Created',
                    'data' => $user
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
    
    /*

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    } */

    /* public function __invoke(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //get credentials from request
        $credentials = $request->only('name', 'password');

        //if auth failed
        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        //if auth success
        return response()->json([
            'success' => true,
            'user'    => auth()->guard('api')->user(),    
            'token'   => $token   
        ], 200);
    } */

    public function login(Request $request) {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 200);
        }
        try{
           if(auth()->attempt(array('name' => $request['name'], 'password' => $request['password'])))
           {$tokenResult = $request->user()->createToken('token-auth')->planTextToken;
           $respon = [
            'status' => 'success' ,
            'msg' => 'Login successfully',
            'errors' => null,
            'content' => [
                'status_code' => 200,
                'access_token' =>$tokenResult,
                'token_type' => 'Bearer',
            ]
            ];
        }
        return response()->json($respon, 200);
        }
        catch(QueryException $e){
           /*  return response()->json([
                'status' => false,

                'message' => "Failed" . $e->errorInfo
            ],502); */
            return response()->json(['error'=>'Unauthorised'], 401);
        }
        
    }

    public function logout()
	{
		auth()->user->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
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
