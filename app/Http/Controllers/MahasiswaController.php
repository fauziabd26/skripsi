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
    public function __construct()
    {
        $this->middleware('auth');
    }
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
            'nim'                   => 'required|unique:mahasiswas,nim',
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

        $mahasiswa = new Mahasiswa;
        $mahasiswa->id      = Uuid::uuid4()->getHex();
        $mahasiswa->nim     = $request->nim;
        $mahasiswa->name    = $request->name;
        $mahasiswa->kelas   = $request->kelas;

        $data = new User;
        $data->id           = Uuid::uuid4()->getHex();
        $data->mahasiswa_id = $mahasiswa->id;
        $data->name         = $mahasiswa->name;
        $data->password     = bcrypt($request->password);
        $data->role_id      = 3;

        $mahasiswa->save();
        $data->save();
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
    public function edit(mahasiswa $mahasiswa, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit',compact('mahasiswa'));
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
        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->nim     = $request->nim;
        $mahasiswa->name    = $request->name;
        $mahasiswa->kelas   = $request->kelas;
        $mahasiswa->update();
        return redirect()->route('index_mahasiswa')->with('pesan', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa, $id)
    {
        try {
            $mahasiswa = Mahasiswa::find($id);
            $mahasiswa->delete();
            return redirect()->route('index_mahasiswa')->with('delete', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index_mahasiswa')->withErrors('Data gagal Dihapus');
        }
    }
}
