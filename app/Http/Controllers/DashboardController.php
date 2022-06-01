<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Barang;
use App\Models\aproval;
use App\Models\peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $mahasiswa = Mahasiswa::count();
        $barang = Barang::count();

        return view('dashboard.index', compact('user','mahasiswa','barang'));

    }
}
