@extends('layouts.main')

@section('content')
<section class="section">
  @if (auth()->user()->role_id == "1")
  <div class="section-header">
    <h1>Dashboard Admin</h1>
  </div>
  <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Semua Pengguna</h4>
            </div>
            <div class="card-body">
              <div class="count">{{$user}}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="{{ route('index_mahasiswa') }}">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Mahasiswa</h4>
            </div>
            <div class="card-body">
              <div class="count">{{$mahasiswa}}</div>
            </div>
          </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="{{ route('index_dosen') }}">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Dosen</h4>
              </div>
              <div class="card-body">
                <div class="count">{{$dosen}}</div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="{{ route('index_barang') }}">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Data Barang</h4>
              </div>
              <div class="card-body">
                <div class="count">{{$barang}}</div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-address-book"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Data Peminjaman</h4>
            </div>
            <div class="card-body">
              <div class="count">{{$peminjaman}}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-address-book"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Data Pengembalian</h4>
            </div>
            <div class="card-body">
              <div class="count">{{$pengembalian}}</div>
            </div>
          </div>
        </div>
      </div>
  </div>
  @elseif (auth()->user()->role_id == "2")
    <div class="section-header">
      <h1>Dashboard Dosen</h1>
    </div>
    <div class="row">
      <h2>Hi, {{ Auth::user()->name }}</h2>
    </div>
  @elseif (auth()->user()->role_id == "3")
    <div class="section-header">
      <h1>Dashboard Mahasiswa</h1>
    </div>
    <div class="row">
      <h2>Hi, {{ Auth::user()->name }}</h2>
    </div>
  @elseif (auth()->user()->role_id == "4")
  <div class="section-header">
      <h1>Dashboard Kepala Laboratorium</h1>
  </div>
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Semua Pengguna</h4>
          </div>
          <div class="card-body">
            <div class="count">{{$user}}</div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Mahasiswa</h4>
            </div>
            <div class="card-body">
              <div class="count">{{$mahasiswa}}</div>
            </div>
          </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Dosen</h4>
              </div>
              <div class="card-body">
                <div class="count">{{$dosen}}</div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Data Barang</h4>
              </div>
              <div class="card-body">
                <div class="count">{{$barang}}</div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-address-book"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Data Peminjaman</h4>
            </div>
            <div class="card-body">
              <div class="count">{{$peminjaman}}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-address-book"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Data Pengembalian</h4>
            </div>
            <div class="card-body">
              <div class="count">{{$pengembalian}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endif
@stop