@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Mahasiswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Mahasiswa</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('tambah_mahasiswa') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Mahasiswa
                        </a>
                    </div>
                </div>
                @if(session()->has('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('alert-success')}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                @if (count($mahasiswa))
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>NIM</th>
                                <th>NAMA MAHASISWA</th>
                                <th>KELAS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($mahasiswa as $data)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ $data->nim }}</td>
                            <td align="center">{{ $data->name }}</td>
                            <td align="center">{{ $data->kelas }}</td>
                            <td align="center">
                                <a href="/mahasiswa/edit/{{ $data->id }}" class="btn btn-warning btn-sm mr-2" title="Edit" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Edit</i></a>
                                <a href="/mahasiswa/delete{{ $data->id }}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus {{ $data->name }} ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col">
                            <div class="alert alert-primary">
                                <i class="fa fa-exclamation-triangle"></i> Data Mahasiswa Belum tersedia
                            </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@stop