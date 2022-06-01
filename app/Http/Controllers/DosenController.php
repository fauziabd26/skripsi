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
            'id'                    => 'required|unique:dosens,id|max:255',
            'name'                  => 'required',
            'keterangan'            => 'required',
            'password'              => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|required_with:password_confirmation|same:password_confirmation|min:8|max:255',
        ],[
            'id.required'                           =>'Nip Dosen tidak boleh kosong',
            'id.unique'                             =>'Nip Dosen sudah terpakai',
            'id.max'                                =>'Nip Dosen max 255 karakter',
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

        $data = $request->all();
        $dosen = new Dosen;
        $dosen->id      = $data['id'];
        $dosen->name    = $data['name'];
        $dosen->keterangan   = $data['keterangan'];

        $user = new User;
        $user->id           = Uuid::uuid4()->getHex();
        $user->dosen_id     = $dosen->id;
        $user->name         = $dosen->name;
        $user->password     = bcrypt($request->password);
        $user->role_id      = 2;

        $dosen->save();
        $user->save();
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
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        //
    }
}
