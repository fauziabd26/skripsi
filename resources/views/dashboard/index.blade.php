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
                    <h4>Total Pengguna</h4>
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
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="{{route('index_suppliers')}}">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="far fa-address-book"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Data Suppliers</h4>
                    </div>
                    <div class="card-body">
                      <div class="count">{{$hitung_suppliers}}</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="{{route('index_barang_masuk')}}">
                  <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="far fa-address-book"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Data Barang Masuk</h4>
                    </div>
                    <div class="card-body">
                      <div class="count">{{$barangmasuk}}</div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
              <div class="card-header">
                    <h4>Data Grafik Supplier Barang</h4>
                  </div>
                <div class="card-body">
                    <div id="suppliers">

                    </div>
                </div>
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

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  Highcharts.chart('suppliers', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            viewDistance: 25,
            depth: 40
        }
    },

    title: {
        text: 'Total stok dari suppliers'
    },

    xAxis: {
        categories: {!!json_encode($suppliers)!!},
        labels: {
            skew3d: true,
            style: {
                fontSize: '16px'
            }
        }
    },

    yAxis: {
        allowDecimals: false,
        min: 0,
        title: {
            text: 'Stok',
            skew3d: true
        }
    },

    tooltip: {
        headerFormat: '<b>{point.key}</b><br>',
        pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
    },

    plotOptions: {
        column: {
            stacking: 'normal',
            depth: 40
        }
    },

    series: [{
        name: 'Stok awal dari Supplier',
        data: {!!json_encode($grafik_stok)!!},
        stack: 'male'
    }]
});
</script>
@stop