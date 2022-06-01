@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Laporan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Laporan</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        @if (auth()->user()->role_id == "1")
                        <a href="{{ route('tambah_dosen') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Laporan
                        </a>
                        <a href="{{ route('export_laporan_barang') }}" class="btn btn-success" title="Export" data-toggle="tooltip">
                            <i class="fas fa-file-export mr-2"></i> Export Excel
                        </a>
                        @elseif (auth()->user()->role_id == "4")

                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    @if (session()->has('alert-success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('alert-success')}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endif
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($laporan as $data)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ $data->name }}</td>
                            <td align="center">{{ $data->keterangan }}</td>
                            <td align="center">
                                <button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat"><i class="fa fa-eye" aria-hidden="true"> Lihat</i></button>
                                <a href="#" class="btn btn-warning btn-sm mr-2" title="Edit" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Edit</i></a>
                                <a href="#" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@stop