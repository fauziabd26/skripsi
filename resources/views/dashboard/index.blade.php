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

          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
              <div class="card-header">
                    <h4>Data Grafik Nama Barang</h4>
                  </div>
                  <div class="card-body">
                    <div id="barang">

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

          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
              <div class="card-header">
                    <h4>Data Grafik Nama Barang</h4>
                  </div>
                  <div class="card-body">
                    <div id="barang">

                    </div>
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
      title: {
          text: 'Top 5 Stok terbanyak dari suppliers'
      },
      xAxis: {
          categories: <?php echo json_encode($suppliers); ?>
      },
      yAxis: {
        allowDecimals: false,
        min: 0,
        title: {
            text: 'Jumlah Stok',
            skew3d: true
        }
      },
      labels: {
          items: [{
              style: {
                  left: '50px',
                  top: '18px',
                  color: ( // theme
                      Highcharts.defaultOptions.title.style &&
                      Highcharts.defaultOptions.title.style.color
                  ) || 'black'
              }
          }]
      },
  
      series: [{
          type: 'column',
          name: 'Stok',
          data: <?php echo json_encode($grafik_stok); ?>,
      }, {
          type: 'spline',
          name: 'Average',
          data: <?php echo json_encode($grafik_stok); ?>,
          marker: {
              lineWidth: 2,
              lineColor: Highcharts.getOptions().colors[3],
              fillColor: 'white'
          }
      }, {
          center: [100, 80],
          size: 100,
          showInLegend: false,
          dataLabels: {
              enabled: false
          }
      }]
  });
  Highcharts.chart('barang', {
    title: {
        text: 'Top 5 Barang terbanyak'
    },
    xAxis: {
        categories: <?php echo json_encode($suppliers2); ?>
    },
    yAxis: {
        allowDecimals: false,
        min: 0,
        title: {
            text: 'Jumlah Barang',
            skew3d: true
        }
      },
    labels: {
        items: [{
            style: {
                left: '50px',
                top: '18px',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'black'
            }
        }]
    },

    series: [{
        type: 'column',
        name: 'Barang',
        data: <?php echo json_encode($grafik_stok2); ?>,
    }, {
        type: 'spline',
        name: 'Average',
        data: <?php echo json_encode($grafik_stok2); ?>,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }, {
        center: [100, 80],
        size: 100,
        showInLegend: false,
        dataLabels: {
            enabled: false
        }
    }]
});
</script>
@stop