<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pengguna;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index()
    {
        $mahasiswa = Mahasiswa::with('user')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.regismhs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nim'                   => 'required|numeric|unique:mahasiswas,nim',
            'name'                  => 'required',
            'kelas'                 => 'required',            
            'password'              => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|required_with:password_confirmation|same:password_confirmation|min:8|max:255',
        ],[
            'nim.required'                          =>'Nim Mahasiswa tidak boleh kosong',
            'nim.unique'                            =>'Nim Mahasiswa sudah ada',
            'name.required'                         =>'Nama Mahasiswa tidak boleh kosong',
            'kelas.required'                        =>'Kelas Mahasiswa tidak boleh kosong',
            'password.required'                     =>'Password tidak boleh kosong',
            'password.confirmed'                    =>'Password harus sama',
            'password.max'                          =>'Password max 255 karakter',
            'password.min'                          =>'Password min 8 karakter',
            'password_confirmation.required'        =>'Password konfirmasi tidak boleh kosong',
            'password_confirmation.required_with'   =>'Password harus sama',
            'password_confirmation.same'            =>'Password harus sama',
            'password_confirmation.max'             =>'Password max 255 karakter',
            'password_confirmation.min'             =>'Password min 8 karakter',
        ]);

        
        $data = new User;
        $data->id           = Uuid::uuid4()->getHex();
        $data->name         = $request->name;
        $data->password     = bcrypt($request->password);
        $data->role_id      = 3;
        
        $mahasiswa = new Mahasiswa;
        $mahasiswa->id      = Uuid::uuid4()->getHex();
        $mahasiswa->nim     = $request->nim;
        $mahasiswa->name    = $request->name;
        $mahasiswa->kelas   = $request->kelas;
        $mahasiswa->user_id = $data->id;

        $data->save();
        $mahasiswa->save();
        return redirect()->route('index_mahasiswa')->with('pesan','Data Mahasiswa dan akun mahasiswa berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(mahasiswa $mahasiswa, $id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa, $user_id)
    {
        try {
            $mahasiswa = Mahasiswa::find($user_id);
            $mahasiswa->user()->delete();
            $mahasiswa->delete();
            return redirect()->route('index_mahasiswa')->with('delete', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index_mahasiswa')->withErrors('Data gagal Dihapus');
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $mahasiswa = Mahasiswa::where('name', 'like', "%" . $keyword . "%")->paginate(5);
        return view('mahasiswa.index', compact('mahasiswa'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
