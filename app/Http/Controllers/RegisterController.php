<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function createAdmin()
    {
        return view('register.regisAdmin');
    }

    public function indexAdmin()
    {
        return view('register.indexAdmin');
    }

    public function createKalab()
    {
        return view('register.regisKalab');
    }

    public function indexKalab()
    {
        return view('register.indexKalab');
    }

    public function storeAdmin(Request $request)
    {
            $this->validate($request, [
                'name'      => 'required|max:255',            
                'password'  => 'required|confirmed|min:8|max:255',
                'password_confirmation'  => 'required|required_with:password_confirmation|same:password_confirmation|min:8|max:255',
            ],[
                'name.required'     =>'Nama tidak boleh kosong',
                'name.max'          =>'Nama max 255 karakter',
                'password.required' =>'Password tidak boleh kosong',
                'password.confirmed' =>'Password harus sama',
                'password.max'      =>'Password max 255 karakter',
                'password.min'      =>'Password min 8 karakter',
                'password_confirmation.required' =>'Password konfirmasi tidak boleh kosong',
                'password_confirmation.required_with'     =>'Password harus sama',
                'password_confirmation.same'     =>'Password harus sama',
                'password_confirmation.max'      =>'Password max 255 karakter',
                'password_confirmation.min'      =>'Password min 8 karakter',
            ]);
    
            $data = new User();
            $data->id = Uuid::uuid4()->getHex();
            $data->name = $request->name;
            $data->password = bcrypt($request->password);
            $data->role_id = 1;
    
            $data->save();
            return redirect()->route('index_admin')->with('alert-success','Data akun berhasil dibuat!');
    }

    public function storeKalab(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',            
            'password'  => 'required|confirmed|min:8|max:255',
            'password_confirmation'  => 'required|required_with:password_confirmation|same:password_confirmation|min:8|max:255',
        ],[
            'name.required'     =>'Nama tidak boleh kosong',
            'name.max'          =>'Nama max 255 karakter',
            'password.required' =>'Password tidak boleh kosong',
            'password.confirmed' =>'Password harus sama',
            'password.max'      =>'Password max 255 karakter',
            'password.min'      =>'Password min 8 karakter',
            'password_confirmation.required' =>'Password konfirmasi tidak boleh kosong',
            'password_confirmation.required_with'     =>'Password harus sama',
            'password_confirmation.same'     =>'Password harus sama',
            'password_confirmation.max'      =>'Password max 255 karakter',
            'password_confirmation.min'      =>'Password min 8 karakter',
        ]);
    
    
            $data = new User();
            $data->id = Uuid::uuid4()->getHex();
            $data->name = $request->name;
            $data->password = bcrypt($request->password);
            $data->role_id = 4;
    
            $data->save();
            return redirect()->route('index_kalab')->with('alert-success','Data akun berhasil dibuat, Silahkan login!');
    }
}
