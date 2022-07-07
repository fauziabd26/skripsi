@extends('layouts.main')

@section('content')
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
                                <th>Nama barang</th>
                                <th>Tanggal Masuk</th>
                                <th>Stok Awal</th>
                                <th>Nama Konsumen</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <?php $no = 1;?>
                        @foreach($datas as $data)
                        <tr>
                            <td align="center">{{ $no++ }}</td>
                            <td align="center">{{ !empty($data->barang) ? $data->barang->name:'' }}</td>
                            <td align="center">{{ $data->tggl_masuk }}</td>
                            <td align="center">{{ $data->stok_awal }}</td>
                            <td align="center">{{ $data->nama_konsumen }} </td>
                            <td align="center" style="width: 30%;">
                                <button type="button" class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat-{{ $data->id }}"><i class="fa fa-eye"> Lihat</i></button>
                                <a href="/barang_masuk/delete{{ $data->id }}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus {{ $data->barang->name }} ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
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
@foreach ($datas as $data)
@foreach ($barang as $b)
<!-- Modal Lihat -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-lihat-{{ $data->id }}" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Barang </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">Nama Barang</div>
                                <div class="col-md-6 ms-auto">{{ !empty($data->barang) ? $data->barang->name:'' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Stok Awal Barang</div>
                                <div class="col-md-6 ms-auto">{{ $data->stok_awal }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Nama Konsumen</div>
                                <div class="col-md-6 ms-auto">{{ $data->nama_konsumen }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Tanggal Masuk</div>
                                <div class="col-md-6 ms-auto">{{ $data->tggl_masuk }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Kategori Barang</div>
                                <div class="col-md-6 ms-auto">{{ !empty($b->kategori) ? $b->kategori->name:'' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Satuan Barang</div>
                                <div class="col-md-6 ms-auto">{{ !empty($b->satuan) ? $b->satuan->name:'' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Gambar Barang</div>
                                <div class="col-md-6 ms-auto"><img src="{{ url('img/barang/'.$data->barang->file) }}" width="150px" alt=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
<!-- END Modal Lihat -->
@endforeach
@endforeach

@stop