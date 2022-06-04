@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Laporan Barang</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('post_kategori') }}" method="POST" enctype="multipart/form-data">
                    @csrf    
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label for="label">Tanggal Awal</label>
                            <input type="date" name="tglawal" id="tglawal" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <label for="label">Tanggal Akhir</label>
                            <input type="date" name="tglakhir" id="tglakhir" class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">    
                            <a href="" onclick="this.href='print_barang_pertanggal/'+document.getElementById('tglawal').value +
                            '/'+document.getElementById('tglakhir').value" target="_blank" class="btn btn-danger">    
                                <span class="icon text-white-55">
                                    <i class="fas fa-print"></i>
                                </span>
                                <span class="text">
                                    Print Laporan PDF
                                </span>
                            </a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>stok</th>
                                <th>Kategori Barang</th>
                                <th>Satuan Barang</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($barang as $data)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ $data->name }}</td>
                            <td align="center">{{ $data->stok }}</td>
                            <td align="center">{{ $data->kategori->name }}</td>
                            <td align="center">{{ $data->satuan->name }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>    
            </div>
        </div>
    </div>
</section>
@stop