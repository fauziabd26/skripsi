<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        return view('login.index');

    }
    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'name'      => 'required',
            'password'  => 'required|min:8|max:255',
        ],[
            'name.required'         =>'Nama Mahasiswa tidak boleh kosong',
            'password.required'     =>'Password tidak boleh kosong',
            'password.max'          =>'Password max 255 karakter',
            'password.min'          =>'Password min 8 karakter',
        ]);
   
        if(auth()->attempt(array('name' => $input['name'], 'password' => $input['password'])))
        {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('dashboard');
            }elseif (auth()->user()->role_id == 2) {
                return redirect()->route('dashboard');
            }elseif (auth()->user()->role_id == 3) {
                return redirect()->route('dashboard');
            }elseif (auth()->user()->role_id == 4) {
                return redirect()->route('dashboard');
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->route('login')
                ->with('error','Akun anda belom ada, Silahkan menghubungi Admin');
        }
          
    }
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }   
}
