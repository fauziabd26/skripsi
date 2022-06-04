<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Barang;
use App\Models\aproval;
use App\Models\Dosen;
use App\Models\peminjaman;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Do_;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
    public function index()
    {
        $user = User::count();
        $mahasiswa = Mahasiswa::count();
        $barang = Barang::count();
        $dosen = Dosen::count();

        return view('dashboard.index', compact('user','mahasiswa','barang','dosen'));
    }

    public function index_kategori()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }
    public function index_mahasiswa()
    {
        $mahasiswa = Mahasiswa::all();
        return view('dashboardmhs.dashboardmhs', compact('mahasiswa'));
    }
    public function index_barang()
    {
        
        $barang = Barang::with('kategori','satuan')->get();
        return view('barang.index', compact('barang'));
    }
    public function index_dosen()
    {
        $dosen = Dosen::all();
        return view('DashboardDosen.DashboardDosen', compact('dosen'));
    }
    
    
}
