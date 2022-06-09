<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Rules\CurrentPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function indexKalab()
    {
        $kalab = DB::table('users')
        ->select('users.name')
        ->where('users.role_id', 'like', "%" . 4 . "%")
        ->get();
        return view('kalab.indexKalab', compact('kalab'));
    }
    public function indexAdmin()
    {
        $admin = DB::table('users')
        ->select('users.name')
        ->where('users.role_id', 'like', "%" . 1 . "%")
        ->get();
        return view('register.indexAdmin', compact('admin'));
    }
    
    public function userProfile() {
        $user = User::findOrFail(Auth::user()->id);
        $data = DB::table('users')
        ->select('users.email')
        ->get();
        return view("user.show_user_profile", compact("user", "data"));
    }
    
    public function edit(Request $request) {
        return view('user.edit', [
            'user' => $request->user()
        ]);
    }

    public function update(Request $request) {
        $this->validate($request, [
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
        ]);
        $request->user()->update(
            $request->all()
        );
        

        return redirect()->route('profile.edit')->with(["success" => "User berhasil diupdate!"]);
    }
    public function editPassword()
    {
        return view('password.edit');
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password'      => ['required', 'string', new CurrentPassword()],
            'password'              => 'required|confirmed|min:8|max:255',
            'password_confirmation' => 'required|required_with:password_confirmation|same:password_confirmation|min:8|max:255',
        ],[
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
        $request->user()->update([
        'password' => Hash::make($request->get('password'))
        ]);

        return redirect()->route('user.password.edit')->with(["success" => "Password berhasil diubah"]);
    }
    
}
