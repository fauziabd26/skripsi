@extends('layouts.main')

@section('content')
@if (auth()->user()->role_id == "1")
<section class="section">
    <div class="section-header">
        <h1>Data Barang Masuk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Barang Masuk</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('tambah_barang_masuk') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Barang Masuk
                        </a>
                    </div>
                </div>
                @if (session('pesan'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> {{ session('pesan') }}.
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @elseif (session('delete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> {{ session('delete') }}.
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama Supplier</th>
                                <th>Transaksi Supplier</th>
                                <th>Stok</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($datas as $data)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ !empty($data->name) ? $data->name:'' }}</td>
                            <td align="center">{{ $data->barangmasuk_count }}</td>
                            <td align="center">{{ $data->barangmasuk()->sum('stok') }}</td>
                            <td align="center" style="width: 30%;">
                                <button type="button" class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat-{{ $data->id }}"><i class="fa fa-eye"> Lihat</i></button>
                            </td>                        
                        </tr>
                        @endforeach
                    </table>
                    Halaman ke: {{ $datas->currentPage() }}<br>
                    Jumlah Semua Data: {{ $datas->total() }}<br>
                    Data perhalaman: {{ $datas->perPage() }}<br>
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@foreach($datas as $data)
<!-- Modal Lihat -->
<div aria-hidden="true" aria-labelledby="exampleModalLabel" role="dialog" tabindex="-1" id="modal-lihat-{{ $data->id }}" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Barang Dari Supplier {{$data->name}} </h5>
            </div>
            @foreach ($data->barangmasuk as $barang)
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">Nama Barang</div>
                        <div class="col-md-6 ms-auto">{{ !empty($barang->barang->name) ? $barang->barang->name:'' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Stok Barang</div>
                        <div class="col-md-6 ms-auto">{{ $barang->stok }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Tanggal Masuk</div>
                        <div class="col-md-6 ms-auto">{{ $barang->tggl_masuk }}</div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="/barang_masuk/edit/{{ $barang->id }}" class="btn btn-warning btn-sm mr-2" title="Edit" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Edit</i></a>
                            <a href="/barang_masuk/delete{{ $barang->id }}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus {{ !empty($barang->barang->name) ? $barang->barang->name: '' }} ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- END Modal Lihat -->
@endforeach
@elseif (auth()->user()->role_id == "4")
<section class="section">
    <div class="section-header">
        <h1>Data Barang Masuk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Barang Masuk</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama Supplier</th>
                                <th>Transaksi Supplier</th>
                                <th>Stok</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($datas as $data)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ !empty($data->name) ? $data->name:'' }}</td>
                            <td align="center">{{ $data->barangmasuk_count }}</td>
                            <td align="center">{{ $data->barangmasuk()->sum('stok') }}</td>
                            <td align="center" style="width: 30%;">
                                <button type="button" class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat-{{ $data->id }}"><i class="fa fa-eye"> Lihat</i></button>
                            </td>                        
                        </tr>
                        @endforeach
                    </table>
                    Halaman ke: {{ $datas->currentPage() }}<br>
                    Jumlah Semua Data: {{ $datas->total() }}<br>
                    Data perhalaman: {{ $datas->perPage() }}<br>
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@foreach($datas as $data)
<!-- Modal Lihat -->
<div aria-hidden="true" aria-labelledby="exampleModalLabel" role="dialog" tabindex="-1" id="modal-lihat-{{ $data->id }}" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Barang Dari Supplier {{$data->name}} </h5>
            </div>
            @foreach ($data->barangmasuk as $barang)
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">Nama Barang</div>
                        <div class="col-md-6 ms-auto">{{ !empty($barang->barang->name) ? $barang->barang->name:'' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Stok Barang</div>
                        <div class="col-md-6 ms-auto">{{ $barang->stok }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Tanggal Masuk</div>
                        <div class="col-md-6 ms-auto">{{ $barang->tggl_masuk }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- END Modal Lihat -->
@endforeach

@endif
@stop