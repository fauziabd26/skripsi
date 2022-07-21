<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <!-- <div class="sidebar-brand">
            <a href="/"><h3> Sistem Informasi Laboratorium Keperawatan</h3></a>
          <a href="/"><img src="{{URL::asset('stisla/img/polindra.png')}}" alt="profile Pic" height="200" width="200">
            "SILK"</a>
          </div> -->
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
              <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
            @if (auth()->user()->role_id == "1")
              <li class="menu-header">Data</li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Data Pengguna</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('index_mahasiswa') }}">Mahasiswa</a></li>
                  <li><a class="nav-link" href="{{ route('index_dosen') }}">Dosen</a></li> 
                  <li><a class="nav-link" href="{{ route('index_kalab') }}">Kepala Laboratorium</a></li> 
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-folder"></i></i> <span>Data Master</span></a>
                <ul class="dropdown-menu">
                  <li class="menu-header">Pilih Menu</li>
                  <li><a class="nav-link" href="{{ route('index_barang') }}">Data Barang</a></li>
                  <li><a class="nav-link" href="{{ route('index_kategori') }}">Kategori Barang</a></li>
                  <li><a class="nav-link" href="{{ route('index_satuan') }}">Satuan Barang</a></li>
                  <li><a class="nav-link" href="{{ route('index_barang_masuk') }}">Data Barang Masuk</a></li>
                  <li><a class="nav-link" href="{{ route('index_suppliers') }}">Data Suppliers</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-folder"></i></i> <span>Data Peminjaman</span></a>
                <ul class="dropdown-menu">
                  <li class="menu-header">Pilih Menu</li>
                  <li><a class="nav-link" href="{{ route('index_Peminjaman') }}">Data Peminjaman</a></li>
                  <li><a class="nav-link" href="{{ route('index_Pengembalian') }}">Data Pengembalian</a></li>
                  <li><a class="nav-link" href="{{ route('Peminjaman_paket') }}">Data Peminjaman Paket</a></li>
                  <li><a class="nav-link" href="{{ route('index_Paket') }}">Data Paket</a></li>
                  <li><a class="nav-link" href="{{ route('index_aproval') }}">Data Aproval</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file"></i></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('index_laporan_barang') }}">Laporan Barang</a></li>
				  <li><a class="nav-link" href="{{ route('index_laporan_peminjaman') }}">Laporan Peminjaman</a></li>
				  <li><a class="nav-link" href="{{ route('laporan_Pengembalian') }}">Laporan Pengembalian</a></li>
				  <li><a class="nav-link" href="{{ route('index_laporan_peminjaman_paket') }}">Laporan Paket</a></li>
                </ul>
              </li>
              @elseif (auth()->user()->role_id == "2")
              <li class="menu-header">Pilih Menu</li>   
              <li class="nav-item dropdown">
                <a href="{{url('/PenggunaDosen')}}" ><i class="fas fa-address-book"></i> <span>Peminjaman</span></a>
              </li>
              @elseif (auth()->user()->role_id == "3")
              <li class="menu-header">Pilih Menu</li>   
              <li class="nav-item dropdown">
                <a href="{{url('/PenggunaMahasiswa')}}" ><i class="fas fa-address-book"></i> <span>Peminjaman</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="{{url('/PenggunaMahasiswaPengembalian')}}" ><i class="fas fa-address-book"></i> <span>Pengembalian</span></a>
              </li>
              @elseif (auth()->user()->role_id == "4")
              <li class="menu-header">Pilih Menu</li>   
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file"></i></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('index_laporan_barang') }}">Laporan Barang</a></li>
                </ul>
              </li>
              @endif
            </ul>
          </aside>
        </div>