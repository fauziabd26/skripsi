@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Dosen</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Dosen</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('tambah_dosen') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Dosen
                        </a>
                    </div>
                </div>
                @if (session()->has('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('alert-success')}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                @if (count($dosen))
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>NIP DOSEN</th>
                                <th>NAMA DOSEN</th>
                                <th>KETERANGAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($dosen as $data)
                        <tr>
                            <td align="center" style="width: 1%;">{{ $no++ }}</td>
                            <td align="center" style="width: 15%;">{{ $data->nip }}</td>
                            <td align="center">{{ $data->name }}</td>
                            <td align="center" style="width: 15%;">{{ $data->keterangan }}</td>
                            <td align="center" style="width: 15%;">
                                <a href="/dosen/delete{{ $data->id }}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus {{ $data->name }} ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col">
                            <div class="alert alert-primary" style="width: 26%;">
                                <i class="fa fa-exclamation-triangle"></i> Data Dosen Belum tersedia
                            </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@stop