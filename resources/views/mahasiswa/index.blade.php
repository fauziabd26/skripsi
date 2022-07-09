@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ route('index_mahasiswa') }}"> <h1>Data Mahasiswa</h1> </a>
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
                    @if (count($mahasiswa))
                        <div class="col">
                            <form class="form" method="get" action="{{ route('cari_mahasiswa') }}">
                                <label for="search" class="d-block mr-2">Pencarian Database Mahasiswa</label>
                                <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan keyword">
                                <button type="submit" class="btn btn-primary mb-1">Cari</button>
                            </form>
                        </div>
                        @endif
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
                            <td align="center" style="width: 1%;">{{ $no++ }}</td>
                            <td align="center" style="width: 3%;">{{ $data->nim }}</td>
                            <td align="center">{{ $data->name }}</td>
                            <td align="center" style="width: 15%;">{{ $data->kelas }}</td>
                            <td align="center" style="width: 15%;">
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