@extends('layouts.main')

@section('content')
    @if (auth()->user()->role_id == "1")
    <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Admin</h4>
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
                    <div class="count">{{$mahasiswa}}</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Barang</h4>
                  </div>
                  <div class="card-body">
                    <div class="count">{{$barang}}</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-address-book"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Data Peminjam</h4>
                  </div>
                  <div class="card-body">
                    <div class="count">{{$peminjaman}}</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
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

          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
              <div class="card-header">
                    <h4>Data Grafik Barang Bulanan</h4>
                  </div>
                <div class="card-body">
                    <canvas id="myChart" height="182"></canvas>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Recent Activities</h4>
                </div>
                @foreach ($online as $data)
                <div class="card-body">
                  <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                     <div class="media-body">
                        <div class="float-right text-primary">
                          @if(Cache::has('user-is-online-' . $data->id))
                            <span class="text-success">Online</span>
                          @else
                            <span class="text-secondary">Offline</span>
                          @endif
                        </div>
                        <div class="media-title">{{ $data->name }}</div>
                        <span class="text-small text-muted">{{ Carbon\Carbon::parse($data->last_seen)->diffForHumans() }}</span>
                      </div>
                  </ul>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </section>
  @elseif (auth()->user()->role_id == "2")
  <section class="section">
  <div class="section-header">
      <h1>Dashboard Dosen</h1>
    </div>
    <div class="row">
      <h2>Hi, {{ Auth::user()->name }}</h2>
    </div>
  </section>
  @elseif (auth()->user()->role_id == "3")
  <section class="section">  
    <div class="section-header">
      <h1>Dashboard Mahasiswa</h1>
    </div>
    <div class="row">
      <h2>Hi, {{ Auth::user()->name }}</h2>
    </div>
  </section>
  @elseif (auth()->user()->role_id == "4")
  <section class="section">
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
    </section>
    @endif
@stop