<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class DosenController extends Controller
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
        $dosen = Dosen::all();
        return view('dosen.index', compact('dosen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.regisdosen');
    }
    /**
    * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nip'                   => 'required|unique:dosens,nip|max:255',
            'name'                  => 'required',
            'keterangan'            => 'required',
            'password'              => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|required_with:password_confirmation|same:password_confirmation|min:8|max:255',
        ],[
            'nip.required'                          =>'Nip Dosen tidak boleh kosong',
            'nip.unique'                            =>'Nip Dosen sudah terpakai',
            'nip.max'                               =>'Nip Dosen max 255 karakter',
            'name.required'                         =>'Nama Dosen tidak boleh kosong',
            'keterangan.required'                   =>'Keterangan Dosen tidak boleh kosong',
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

        $dosen = new Dosen();
        $dosen->id          = Uuid::uuid4()->getHex();
        $dosen->nip         = $request->nip;
        $dosen->name        = $request->name;
        $dosen->keterangan  = $request->kelas;

        $data = new User();
        $data->id           = Uuid::uuid4()->getHex();
        $data->dosen_id     = $dosen->id;
        $data->name         = $dosen->name;
        $data->password     = bcrypt($request->password);
        $data->role_id      = 2;

        $dosen->save();
        $data->save();
        return redirect()->route('index_dosen')->with('alert-success','Data dosen dan akun dosen berhasil dibuat!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen, $id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit',compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen , $id)
    {
        $dosen = Dosen::findOrFail($id);

        $dosen->nip         = $request->nip;
        $dosen->name        = $request->name;
        $dosen->keterangan  = $request->keterangan;
        $dosen->update();
        return redirect()->route('index_dosen')->with('pesan', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen, $id)
    {
        try {
            $dosen = Dosen::find($id);
            $dosen->delete();
            return redirect()->route('index_dosen')->with('delete', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('index_dosen')->withErrors('Data gagal Dihapus');
        }
    }
}
