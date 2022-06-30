@extends('layouts.main')

@section('content')
<section class="section">
<div class="section-header">
        <h1>Edit Data peminjaman</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Data peminjaman</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('index_Peminjaman_pengguna') }}" class="btn btn-primary" title="Back" data-toggle="tooltip">
                            <i class="fas fa-angle-left mr-2"></i> Kembali ke Data peminjaman
                        </a>
                    </div>
                </div>
                <form action="/PenggunaMahasiswa/add/{{ $kem->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')    
                    @csrf
                    <div class="row">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="k_barang">Kode Barang</label>
                            <input type="text" name="k_barang" class="form-control" value="{{ $kem->id }}" readonly>
                            <div class="text-danger">
                               @error('k_barang')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="n_barang">Nama Barang</label>
                            <input type="text" name="n_barang" class="form-control" value="{{ $kem->name }}"readonly>
                            <div class="text-danger">
                               @error('n_barang')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
						
                    </div>
					<div class="row">
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="kategori_b">Kategori Barang</label>
                            <input type="text" name="kategori_b" class="form-control" value="{{ $kem->k_name }}"readonly>
                            <div class="text-danger">
                               @error('kategori_b')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="s_barang">Satuan Barang</label>
                            <input type="text" name="s_barang" class="form-control" value="{{ $kem->s_name }}"readonly>
                            <div class="text-danger">
                               @error('s_barang')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="n_peminjam">Nama Peminjam</label>
                            <input type="text" name="n_peminjam" class="form-control">
                            <div class="text-danger">
                               @error('n_peminjam')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="jumlah_peminjam">Jumlah Peminjam</label>
                            <input type="number" name="jumlah_peminjam" class="form-control" value="{{ $kem->jumlah_peminjam }}">
                            <div class="text-danger">
                               @error('jumlah_peminjam')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
                    </div>
					 <div class="row">
                        <div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="t_peminjaman">Tanggal Peminjaman</label>
                            <input type="date" name="t_peminjaman" class="form-control">
                            <div class="text-danger">
                               @error('t_peminjaman')
                                   {{ $message }}
                               @enderror
                            </div>
                        </div>
						<div class="form-group col-6 col-md-3 col-lg-3">
                            <label class="control-label" for="w_peminjaman">Waktu Peminjaman</label>
                            <input type="time" name="w_peminjaman" class="form-control">
                            <div class="text-danger">
                                @error('w_peminjaman')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                   
                        <div class="form-group">
                            <input type="submit"  value="Simpan" class="btn btn-primary">
                        </div>
                </form>
            </div>
        </div>
    </div>

</section>
@stop