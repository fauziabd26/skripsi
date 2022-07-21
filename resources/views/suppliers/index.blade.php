@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Supplier</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Supplier</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('tambah_suppliers') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data supplier
                        </a>
                    </div>
                    @if (count($suppliers))
                    <div class="col">
                        <form class="form" method="get" action="{{ route('cari_suppliers') }}">
                            <label for="search" class="d-block mr-2">Pencarian</label>
                            <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan keyword">
                            <button type="submit" class="btn btn-primary mb-1">Cari</button>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="table-responsive">
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
                    @if (count($suppliers))
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="thead-dark" align="center">
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($suppliers as $data)
                        <tr>
                            <td align="center" style="width: 0%;">{{ $no++ }}</td>
                            <td align="center" style="width: 15%;">{{ $data->name }}</td>
                            <td align="center" style="width: 15%;">{{ $data->alamat }}</td>
                            <td align="center" style="width: 3% ;">{{ $data->email }}</td>
                            <td align="center" style="width: 15%;">{{ $data->telepon }}</td>
                            <td align="center" style="width: 21%;">
                                <a href="/suppliers/edit/{{ $data->id }}" class="btn btn-warning btn-sm mr-2" title="Edit" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Edit</i></a>
                                <a href="/suppliers/delete{{ $data->id }}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus {{ $data->name }} ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col">
                            <div class="alert alert-primary" style="width: 26%;">
                                <i class="fa fa-exclamation-triangle"></i> Data Supplier Belum tersedia
                            </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@stop