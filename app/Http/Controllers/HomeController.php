<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Barang;
use App\Models\aproval;
use App\Models\BarangMasuk;
use App\Models\Dosen;
use App\Models\peminjaman;
use App\Models\Kategori;
use App\Models\pengembalian;
use App\Models\Satuan;
use App\Models\Suppliers;
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
        $peminjaman = peminjaman::count();
        $pengembalian = pengembalian::count();
        $namakonsumen = Suppliers::all();
        $hitung_suppliers = Suppliers::count();
        $barangmasuk = BarangMasuk::count();
        $online = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate(5);
        $suppliers = [];
        $grafik_stok =[];
        foreach ($namakonsumen as $data ) {
            # code...
            $suppliers[]=$data->name;
            $grafik_stok[]=BarangMasuk::where('suppliers_id', $data->id)->sum('stok');
        }

        return view('dashboard.index', compact('user','mahasiswa','barang','dosen','peminjaman','pengembalian','online','suppliers','grafik_stok','hitung_suppliers','barangmasuk'));
    }

    public function grafik()
    {
        $stok=Barang::select(DB :: raw("CAST(SUM(stok)as int)as stok"),DB :: raw("MONTHNAME(created_at)as bulan"))  
                ->GroupBy('stok','bulan')
                ->get();
        return response()->json($stok,200);
    }

    public function index_kategori()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }
    public function index_barang()
    {
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        $barangmasuk = BarangMasuk::all();
        $barang = Barang::with('kategori','satuan','barangmasuk')->latest()->paginate(5);
        $names = Barang::select('name')
                           ->groupBy('name')
                           ->get();
        return view('barang.index', compact('barang','satuans','kategoris','names','barangmasuk'));
    }
    public function index_dosen()
    {
        $dosen = Dosen::all();
        return view('DashboardDosen.DashboardDosen', compact('dosen'));
    }
}
