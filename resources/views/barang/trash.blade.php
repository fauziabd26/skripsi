@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Recycle Bin Data Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Recycle Bin Data Barang</div>
        </div>
    </div>
    <div class="section-body">
    <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_barang') }}" class="btn btn-primary" title="Kembali" data-toggle="tooltip">

                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data Barang
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('restore_all_barang') }}" class="btn btn-success" title="Restore Semua" data-toggle="tooltip">
                        <i class="fas fa-trash-can-undo mr-2"></i> Restore Semua Data Barang
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('delete_all') }}" class="btn btn-danger" title="Hapus Permanen" data-toggle="tooltip">
                        <i class="fas fa-trash mr-2"></i> Hapus semua Data Barang
                        </a>
                    </div>
                </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{ session('success') }}.
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
                    @if (count($barang))
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead class="thead-dark" align="center">
                                <tr>
                                <th>NO</th>
                                <th>Nama Barang</th>
                                <th>stok</th>
                                <th>Kategori Barang</th>
                                <th>Satuan Barang</th>
                                <th>AKSI</th>
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
                            <td>
								<a href="/barang/kembalikan/{{ $data->id }}" class="btn btn-success btn-sm mr-2">Restore</a>
								<a href="/barang/hapus_permanen/{{ $data->id }}" class="btn btn-danger btn-sm mr-2">Hapus Permanen</a>
							</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col">
                        <div class="alert alert-primary">
                            <i class="fa fa-exclamation-triangle"></i> Data Barang Belum terhapus
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@stop