<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
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
            'id'                    => 'required|unique:mahasiswas,id|max:255',
            'name'                  => 'required',
            'kelas'                 => 'required',            
            'password'              => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|required_with:password_confirmation|same:password_confirmation|min:8|max:255',
        ],[
            'id.required'                           =>'Nim Mahasiswa tidak boleh kosong',
            'id.unique'                             =>'Nim Mahasiswa sudah terpakai',
            'id.max'                                =>'Nim Mahasiswa max 255 karakter',
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

        $data = $request->all();
        $mahasiswa = new Mahasiswa;
        $mahasiswa->id      = $data['id'];
        $mahasiswa->name    = $data['name'];
        $mahasiswa->kelas   = $data['kelas'];

        $user = new User;
        $user->id           = Uuid::uuid4()->getHex();
        $user->mahasiswa_id = $mahasiswa->id;
        $user->name         = $mahasiswa->name;
        $user->password     = bcrypt($request->password);
        $user->role_id      = 3;

        $mahasiswa->save();
        $user->save();
        return redirect()->route('index_mahasiswa')->with('alert-success','Data Mahasiswa dan akun mahasiswa berhasil dibuat!');
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
    public function edit(mahasiswa $mahasiswa)
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
    public function update(Request $request, mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(mahasiswa $mahasiswa)
    {
        //
    }
}
