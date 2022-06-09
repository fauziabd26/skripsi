@extends('layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{ route('index_barang') }}"><h1>Data Barang</h1></a>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Data Barang</div>
        </div>
    </div>
    <div class="section-body">
    <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('tambah_barang') }}" class="btn btn-primary" title="Tambah" data-toggle="tooltip">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Barang
                        </a>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-plus mr-2"></i>Import Data Barang
                        </button>
                    </div>
                    @if (count($barang))
                    <div class="col">
                        <form class="form" method="get" action="{{ route('cari_barang') }}">
                            <label for="search" class="d-block mr-2">Pencarian</label>
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
                            <td align="center">{{ !empty($data->kategori) ? $data->kategori->name:'' }}</td>
                            <td align="center">{{ !empty($data->satuan) ? $data->satuan->name:'' }}</td>
                            <td align="center">
                                <button type="button" class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal-lihat-{{ $data->id }}"><i class="fa fa-eye"> Lihat</i></button>
                                <a href="/barang/edit/{{ $data->id }}" class="btn btn-warning btn-sm mr-2" title="Edit" data-toggle="tooltip"><i class="fa fa-pen" aria-hidden="true"> Edit</i></a>
                                <a href="/barang/delete{{ $data->id }}" class="btn btn-danger btn-sm mr-2" title="Hapus" data-toggle="tooltip" onclick="return confirm('Anda yakin mau menghapus {{ $data->name }} ?')"><i class="fa fa-trash" aria-hidden="true"> Hapus</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    
                    <br>
                    Halaman             : {{ $barang->currentPage() }} <br/>
	                Jumlah Data         : {{ $barang->total() }} <br/>
	                Data Per Halaman    : {{ $barang->perPage() }} <br/>
 
 
	                {{ $barang->links() }}
                </div>
                @else
                <div class="row mb-3">
                    <div class="col">
                            <div class="alert alert-primary">
                                <i class="fa fa-exclamation-triangle"></i> Data Barang Belum tersedia
                            </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@foreach ($barang as $data)
<!-- Modal Lihat -->
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" role="dialog" tabindex="-1" id="modal-lihat-{{ $data->id }}" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Barang </h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">Nama Barang</div>
                                <div class="col-md-6 ms-auto">{{ $data->name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Stok Barang</div>
                                <div class="col-md-6 ms-auto">{{ $data->stok }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Kategori Barang</div>
                                <div class="col-md-6 ms-auto">{{ !empty($data->kategori) ? $data->kategori->name:'' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Satuan Barang</div>
                                <div class="col-md-6 ms-auto">{{ !empty($data->satuan) ? $data->satuan->name:'' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Gambar Barang</div>
                                <div class="col-md-6 ms-auto"><img src="{{ url('img/barang/'.$data->file) }}" width="150px" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- END Modal Lihat -->
@endforeach

<!-- Modal Import-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                        <button type="submit" class="btn btn-primary mb-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@stop